<?php

namespace Destiny;

use App\Enums\ComponentTypes;

/**
 * Class DestinyComponentUrlBuilder.
 */
class DestinyComponentUrlBuilder
{
    /**
     * @var array
     */
    public $components;

    /**
     * @var string
     */
    public $uri;

    /**
     * DestinyComponentUrlBuilder constructor.
     *
     * @param $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return string
     */
    public function buildUrl(): string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getComponentArray(): array
    {
        return [
            'components' => implode(',', $this->components),
        ];
    }

    /**
     * Profiles is the most basic component, only relevant when calling GetProfile.
     * This returns basic information about the profile, which is almost nothing: a list of characterIds,
     * some information about the last time you logged in, and that most sobering statistic: how long you've played.
     *
     * @return $this
     */
    public function addProfiles(): self
    {
        $this->components[] = ComponentTypes::PROFILES;

        return $this;
    }

    /**
     * Only applicable for GetProfile, this will return information about receipts for refundable vendor items.
     *
     * @return $this
     */
    public function addVendorReceipts(): self
    {
        $this->components[] = ComponentTypes::VENDOR_RECEIPTS;

        return $this;
    }

    /**
     * Asking for this will get you the profile-level inventories, such as your Vault buckets
     * (yeah, the Vault is really inventory buckets located on your Profile).
     *
     * @return $this
     */
    public function addProfileInventories(): self
    {
        $this->components[] = ComponentTypes::PROFILE_INVENTORIES;

        return $this;
    }

    /**
     * This will get you a summary of items on your Profile that we consider to be "currencies",such as Glimmer.
     * I mean, if there's Glimmer in Destiny 2. I didn't say there was Glimmer.
     *
     * @return $this
     */
    public function addProfileCurrencies(): self
    {
        $this->components[] = ComponentTypes::PROFILE_CURRENCIES;

        return $this;
    }

    /**
     * This will get you any progression-related information that exists on a Profile-wide level, across all characters.
     *
     *
     * @return $this
     */
    public function addProfileProgression(): self
    {
        $this->components[] = ComponentTypes::PROFILE_PROGRESSION;

        return $this;
    }

    /**
     * This will get you information about the silver that this profile has on every platform on which it plays.
     * You may only request this component for the logged in user's Profile, and will not receive it if
     * you request it for another Profile.
     *
     * @return $this
     */
    public function addProfileSilver(): self
    {
        $this->components[] = ComponentTypes::PROFILE_SILVER;

        return $this;
    }

    /**
     * This will get you summary info about each of the characters in the profile.
     *
     * @return $this
     */
    public function addCharacters(): self
    {
        $this->components[] = ComponentTypes::CHARACTERS;

        return $this;
    }

    /**
     * This will get you information about any non-equipped items on the character or character(s)in question,
     * if you're allowed to see it.
     * You have to either be authenticated as that user, or that user must allow anonymous viewing
     * of their non-equipped items in Bungie.Net settings to actually get results.
     *
     * @return $this
     */
    public function addCharacterInventories(): self
    {
        $this->components[] = ComponentTypes::CHARACTER_INVENTORIES;

        return $this;
    }

    /**
     * This will get you information about the progression (faction, experience, etc... "levels") relevant to each
     * character, if you are the currently authenticated user or the user has elected to allow anonymous viewing
     * of its progression info.
     *
     * @return $this
     */
    public function addCharacterProgressions(): self
    {
        $this->components[] = ComponentTypes::CHARACTER_PROGRESSIONS;

        return $this;
    }

    /**
     * This will get you just enough information to be able to render the character in 3D if you have written a
     * 3D rendering library for Destiny Characters, or "borrowed" ours. It's okay, I won't tell anyone if you're using
     * it. I'm no snitch. (actually, we don't care if you use it - go to town).
     *
     * @return $this
     */
    public function addCharacterRenderData(): self
    {
        $this->components[] = ComponentTypes::CHARACTER_RENDER_DATA;

        return $this;
    }

    /**This will return info about activities that a user can see and gating on it, if you are the currently
     * authenticated user or the user has elected to allow anonymous viewing of its progression info.
     * Note that the data returned by this can be unfortunately problematic and relatively unreliable in some cases.
     * We'll eventually work on making it more consistently reliable.
     *
     * @return $this
     */
    public function addCharacterActivities(): self
    {
        $this->components[] = ComponentTypes::CHARACTER_ACTIVITIES;

        return $this;
    }

    /**
     * This will return info about the equipped items on the character(s). Everyone can see this.
     *
     * @return $this
     */
    public function addCharacterEquipment(): self
    {
        $this->components[] = ComponentTypes::CHARACTER_EQUIPMENT;

        return $this;
    }

    /**
     * This will return basic info about instanced items - whether they can be equipped, their tracked status,
     * and some info commonly needed in many places (current damage type, primary stat value, etc).
     *
     * @return $this
     */
    public function addItemInstances(): self
    {
        $this->components[] = ComponentTypes::ITEM_INSTANCES;

        return $this;
    }

    /**
     * Items can have Objectives (DestinyObjectiveDefinition) bound to them. If they do, this will return info
     * for items that have such bound objectives.
     *
     * @return $this
     */
    public function addItemObjectives(): self
    {
        $this->components[] = ComponentTypes::ITEM_OBJECTIVES;

        return $this;
    }

    /**
     * Items can have perks (DestinyPerkDefinition). If they do, this will return info for what perks
     * are active on items.
     *
     * @return $this
     */
    public function addItemPerks(): self
    {
        $this->components[] = ComponentTypes::ITEM_PERKS;

        return $this;
    }

    /**
     * If you just want to render the weapon, this is just enough info to do that rendering.
     *
     * @return $this
     */
    public function addItemRenderData(): self
    {
        $this->components[] = ComponentTypes::ITEM_RENDER_DATA;

        return $this;
    }

    /**
     * Items can have stats, like rate of fire. Asking for this component will return
     * requested item's stats if they have stats.
     *
     * @return $this
     */
    public function addStats(): self
    {
        $this->components[] = ComponentTypes::ITEM_STATS;

        return $this;
    }

    /**
     * Items can have sockets, where plugs can be inserted. Asking for this component will
     * return all info relevant to the sockets on items that have them.
     *
     * @return $this
     */
    public function addSockets(): self
    {
        $this->components[] = ComponentTypes::ITEM_SOCKETS;

        return $this;
    }

    /**
     * Items can have talent grids, though that matters a lot less frequently than it used to. Asking for this component
     * will return all relevant info about activated Nodes and Stepson this talent grid, like the good ol' days.
     *
     * @return $this
     */
    public function addTalentGrids(): self
    {
        $this->components[] = ComponentTypes::ITEM_TALENT_GRIDS;

        return $this;
    }

    /**
     * Items that *aren't* instanced still have important information you need to know:how much of it you have,
     * the itemHash so you can look up their DestinyInventoryItemDefinition,whether they're locked, etc...
     * Both instanced and non-instanced items will have these properties.
     *
     * @return $this
     */
    public function addCommonData(): self
    {
        $this->components[] = ComponentTypes::ITEM_COMMON_DATA;

        return $this;
    }

    /**
     * Items that are "Plugs" can be inserted into sockets. This returns statuses about those plugs and why they
     * can/can't be inserted. I hear you giggling, there's nothing funny about inserting plugs.
     * Get your head out of the gutter and pay attention!
     *
     * @return $this
     */
    public function addItemPlugStates(): self
    {
        $this->components[] = ComponentTypes::ITEM_PLUG_STATES;

        return $this;
    }

    /**
     * When obtaining vendor information, this will return summary information about the Vendor
     * or Vendors being returned.
     *
     *
     * @return $this
     */
    public function addVendors(): self
    {
        $this->components[] = ComponentTypes::VENDORS;

        return $this;
    }

    /**
     * When obtaining vendor information, this will return information about the categories of
     * items provided by the Vendor.
     *
     * @return $this
     */
    public function addVendorCategories(): self
    {
        $this->components[] = ComponentTypes::VENDOR_CATEGORIES;

        return $this;
    }

    /**
     * When obtaining vendor information, this will return the information about items being sold by the Vendor.
     *
     * @return $this
     */
    public function addVendorSales(): self
    {
        $this->components[] = ComponentTypes::VENDOR_SALES;

        return $this;
    }

    /**
     * Asking for this component will return you the account's Kiosk statuses: that is,
     * what items have been filled out/acquired. But only if you are the currently authenticated user
     * or the user has elected to allow anonymous viewing of its progression info.
     *
     * @return $this
     */
    public function addKiosks(): self
    {
        $this->components[] = ComponentTypes::KIOSKS;

        return $this;
    }

    /**
     * A "shortcut" component that will give you all of the item hashes/quantities of items that the requested
     * character can use to determine if an action (purchasing, socket insertion) has the required currency.
     * (recall that all currencies are just items, and that some vendor purchases require items that you might
     * not traditionally consider to be a "currency", like plugs/mods!).
     *
     * @return $this
     */
    public function addCurrencyLookups(): self
    {
        $this->components[] = ComponentTypes::CURRENCY_LOOKUP;

        return $this;
    }

    /**
     * Returns summary status information about all "Presentation Nodes". See DestinyPresentationNodeDefinition
     * for more details, but the gist is that these are entities used by the game UI to bucket Collectibles and Records
     * into a hierarchy of categories. You may ask for and use this data if you want to perform similar bucketing
     * in your own UI: or you can skip it and roll your own.
     *
     * @return $this
     */
    public function addPresentationNodes(): self
    {
        $this->components[] = ComponentTypes::PRESENTATION_NODES;

        return $this;
    }

    /**
     * Returns summary status information about all "Collectibles". These are records of what items you've discovered
     * while playing Destiny, and some other basic information. For detailed information, you will have to call
     * a separate endpoint devoted to the purpose.
     *
     * @return $this
     */
    public function addCollectibles(): self
    {
        $this->components[] = ComponentTypes::COLLECTIBLES;

        return $this;
    }

    /**
     * Returns summary status information about all "Records (also known in the game as "Triumphs". I know, it's
     * confusing because there's also "Moments of Triumph" that will themselves be represented as "Triumphs.").
     *
     * @return $this
     */
    public function addRecords(): self
    {
        $this->components[] = ComponentTypes::RECORDS;

        return $this;
    }

    /**
     * Returns information that Bungie considers to be "Transitory": data that may change too frequently or
     * come from a non-authoritative source such that we don't consider the data to be fully trustworthy,
     * but that might prove useful for some limited use cases. We can provide no guarantee of timeliness nor
     * consistency for this data: buyer beware with the Transitory component.
     *
     * @return $this
     */
    public function addTransitory(): self
    {
        $this->components[] = ComponentTypes::TRANSITORY;

        return $this;
    }
}
