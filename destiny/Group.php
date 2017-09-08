<?php

declare(strict_types=1);

namespace Destiny;

/**
 * Class Group.
 * @property int $groupId
 * @property string $name
 * @property int $groupType
 * @property int $membershipIdCreated
 * @property string $creationDate
 * @property string $modificationDate
 * @property string $about
 * @property array $tags
 * @property int $memberCount
 * @property bool $isPublic
 * @property bool $isPublicTopicAdminOnly
 * @property int $primaryAlliedGroupId
 * @property string $motto
 * @property bool $allowChat
 * @property bool $isDefaultPostPublic
 * @property int $chatSecurity
 * @property string $locale
 * @property int $avatarImageIndex
 * @property int $homepage
 * @property int $membershipOption
 * @property int $defaultPublicity
 * @property string $theme
 * @property string $bannerPath
 * @property string $avatarPath
 * @property bool $isAllianceOwner
 * @property int $conversationId
 * @property bool $enableInvitationMessagingForAdmins
 * @property string $banExpireDate
 * @property array $features
 * @property array $clanInfo
 */
class Group extends Model
{
    public function __construct(array $properties)
    {
        parent::__construct($properties);
    }
}
