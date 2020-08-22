<?php

namespace App\Providers;

use App\Account;
use App\Models\Bungie;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;

class BungieSocialiteProvider extends AbstractProvider implements ProviderInterface
{
    public bool $isRefresh = false;
    public string $baseUrl = 'https://www.bungie.net/';

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->baseUrl.'en/oauth/authorize', $state);
    }

    protected function getTokenUrl(): string
    {
        return $this->baseUrl.'platform/app/oauth/token/';
    }

    protected function getUserUrl(): string
    {
        return $this->baseUrl.'Platform/User/GetMembershipsForCurrentUser/';
    }

    public function refreshToken(Bungie $bungie): Bungie
    {
        $this->isRefresh = true;

        try {
            $tokenResponse = $this->getAccessTokenResponse($bungie->refresh_token);
        } catch (ClientException $ex) {
            \Session::flash('warning', 'Bungie seems to be offline. So we have logged you out.');

            return $bungie;
        }

        $bungie->access_token = $tokenResponse['access_token'];
        $bungie->expires = $tokenResponse['expires_in'];
        $bungie->refresh_token = $tokenResponse['refresh_token'];
        $bungie->refresh_expires = $tokenResponse['refresh_expires_in'];

        if ($bungie->saveOrFail()) {
            return $bungie;
        }

        throw new \Exception('Could not refresh token from Bungie.');
    }

    public function user()
    {
        if ($this->hasInvalidState()) {
            throw new InvalidStateException();
        }

        $tokenResponse = $this->getAccessTokenResponse($this->getCode());
        $token = Arr::get($tokenResponse, 'access_token');
        $bungieId = Arr::get($tokenResponse, 'membership_id');

        // if we have this membershipId, just update and move on
        /** @var Bungie $bungie */
        $bungie = Bungie::where('membership_id', $bungieId)->first();

        if ($bungie === null) {
            $response = json_decode($this->getHttpClient()->get($this->getUserUrl(), [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-API-Key'     => config('destiny.key'),
                    'Accept'        => 'application/json',
                ],
            ])->getBody(), true);

            if (isset($response['ErrorCode']) && $response['ErrorCode'] != 1) {
                \Log::info(print_r($response, true));

                throw new \Exception('Could not reach Bungie API');
            }

            return $this->mapResponsesToNewBungieObject($tokenResponse, $response['Response']);
        } else {
            $bungie->access_token = $tokenResponse['access_token'];
            $bungie->expires = $tokenResponse['expires_in'];
            $bungie->refresh_token = $tokenResponse['refresh_token'];
            $bungie->refresh_expires = $tokenResponse['refresh_expires_in'];

            if ($bungie->saveOrFail()) {
                return $bungie;
            }
        }
    }

    /**
     * @param array $tokenResponse
     * @param array $destinyResponse
     *
     * @throws \Exception
     *
     * @return Bungie
     */
    public function mapResponsesToNewBungieObject(array $tokenResponse, array $destinyResponse)
    {
        $bungie = new Bungie([
            'membership_id'   => $tokenResponse['membership_id'],
            'first_access'    => Arr::get($destinyResponse, 'bungieNetUser.firstAccess'),
            'last_update'     => Arr::get($destinyResponse, 'bungieNetUser.lastUpdate'),
            'unique_name'     => Arr::get($destinyResponse, 'bungieNetUser.uniqueName'),
            'display_name'    => Arr::get($destinyResponse, 'bungieNetUser.displayName'),
            'refresh_token'   => $tokenResponse['refresh_token'],
            'refresh_expires' => $tokenResponse['refresh_expires_in'],
            'access_token'    => $tokenResponse['access_token'],
            'expires'         => $tokenResponse['expires_in'],
        ]);

        $bungie->saveOrFail();

        foreach ($destinyResponse['destinyMemberships'] as $destinyMembership) {

            /** @var Account $model */
            $model = Account::firstOrCreate([
                'membership_id'   => $destinyMembership['membershipId'],
                'membership_type' => $destinyMembership['membershipType'],
            ], [
                'name' => $destinyMembership['displayName'],
            ]);

            $model->bungie_id = $bungie->id;

            if (!$model->save()) {
                throw new \Exception('Object could not be saved.');
            }
        }

        return $bungie;
    }

    /**
     * Get the GET parameters for the code request. Removing "scopes" as they are defined
     * during application creation.
     *
     * @param string|null $state
     *
     * @return array
     */
    protected function getCodeFields($state = null)
    {
        $fields = [
            'client_id'     => $this->clientId,
            'response_type' => 'code',
        ];

        if ($this->usesState()) {
            $fields['state'] = $state;
        }

        return array_merge($fields, $this->parameters);
    }

    /**
     * @param string $code
     *
     * @return array
     */
    protected function getTokenFields($code)
    {
        if ($this->isRefresh) {
            return [
                'grant_type'    => 'refresh_token',
                'refresh_token' => $code,
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
            ];
        }

        return [
            'code'          => $code,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type'    => 'authorization_code',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getUserByToken($token)
    {
        return (new Account());
    }

    /**
     * @inheritDoc
     */
    protected function mapUserToObject(array $user)
    {
        // TODO: Implement mapUserToObject() method.
    }
}
