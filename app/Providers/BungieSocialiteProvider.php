<?php

namespace App\Providers;

use App\Account;
use App\Models\Bungie;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;

/**
 * Class BungieSocialiteProvider.
 */
class BungieSocialiteProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * Flag to determine difference between Access Token refresh or creation.
     *
     * @var bool
     */
    public $isRefresh = false;

    /**
     * @var string
     */
    public $baseUrl = 'https://www.bungie.net/';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->baseUrl.'en/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl() : string
    {
        return $this->baseUrl.'platform/app/oauth/token/';
    }

    /**
     * @param string $bungieId
     *
     * @return string
     */
    protected function getUserUrl(string $bungieId) : string
    {
        return $this->baseUrl.'platform/user/getmembershipsbyid/'.$bungieId.'/0/';
    }

    /**
     * @param Bungie $bungie
     *
     * @throws \Exception
     *
     * @return Bungie
     */
    public function refreshToken(Bungie $bungie)
    {
        $this->isRefresh = true;

        $tokenResponse = $this->getAccessTokenResponse($bungie->refresh_token);

        $bungie->access_token = $tokenResponse['access_token'];
        $bungie->expires = $tokenResponse['expires_in'];
        $bungie->refresh_token = $tokenResponse['refresh_token'];
        $bungie->refresh_expires = $tokenResponse['refresh_expires_in'];

        if ($bungie->save()) {
            return $bungie;
        }

        throw new \Exception('Could not refresh token from Bungie.');
    }

    /**
     * {@inheritdoc}
     */
    public function user()
    {
        if ($this->hasInvalidState()) {
            throw new InvalidStateException();
        }

        $tokenResponse = $this->getAccessTokenResponse($this->getCode());
        $token = Arr::get($tokenResponse, 'access_token');
        $bungieId = Arr::get($tokenResponse, 'membership_id');

        // if we have this membershipId, just update and move on
        /** @var Bungie $model */
        $model = Bungie::where('membership_id', $bungieId)->first();

        if ($model === null) {
            $response = json_decode($this->getHttpClient()->get($this->getUserUrl($bungieId), [
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
            $model->access_token = $tokenResponse['access_token'];
            $model->expires = $tokenResponse['expires_in'];
            $model->refresh_token = $tokenResponse['refresh_token'];
            $model->refresh_expires = $tokenResponse['refresh_expires_in'];

            if ($model->save()) {
                return $model;
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
        foreach ($destinyResponse['destinyMemberships'] as $destinyMembership) {

            /** @var Account $model */
            $model = Account::firstOrCreate([
                'membership_id'   => $destinyMembership['membershipId'],
                'membership_type' => $destinyMembership['membershipType'],
            ], [
                'name' => $destinyMembership['displayName'],
            ]);

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

            if ($model->bungie()->save($bungie)) {
                return $bungie;
            }

            throw new \Exception('Saved failed.');
        }
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
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        return parent::getUserByToken($token);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return parent::mapUserToObject($user);
    }
}
