<?php

namespace App\Enums;

/**
 * Class ComponentTypes.
 */
abstract class ComponentTypes
{
    const NONE = 0;

    const PROFILES = 100;

    const VENDOR_RECEIPTS = 101;

    const PROFILE_INVENTORIES = 102;

    const PROFILE_CURRENCIES = 103;

    const PROFILE_PROGRESSION = 104;

    const PROFILE_SILVER = 105;

    const CHARACTERS = 200;

    const CHARACTER_INVENTORIES = 201;

    const CHARACTER_PROGRESSIONS = 202;

    const CHARACTER_RENDER_DATA = 203;

    const CHARACTER_ACTIVITIES = 204;

    const CHARACTER_EQUIPMENT = 205;

    const ITEM_INSTANCES = 300;

    const ITEM_OBJECTIVES = 301;

    const ITEM_PERKS = 302;

    const ITEM_RENDER_DATA = 303;

    const ITEM_STATS = 304;

    const ITEM_SOCKETS = 305;

    const ITEM_TALENT_GRIDS = 306;

    const ITEM_COMMON_DATA = 307;

    const ITEM_PLUG_STATES = 308;

    const VENDORS = 400;

    const VENDOR_CATEGORIES = 401;

    const VENDOR_SALES = 402;

    const KIOSKS = 500;

    const CURRENCY_LOOKUP = 600;

    const PRESENTATION_NODES = 700;

    const COLLECTIBLES = 800;

    const RECORDS = 900;

    const TRANSITORY = 1000;
}
