<?php declare(strict_types=1);

namespace backend\modules\adminlte;


class AdminView
{
    /**
     * Layouts.
     */
    const LAYOUT_FIXED = 'fixed';
    const LAYOUT_SIDEBAR_MINI = 'sidebar-mini';
    const LAYOUT_SIDEBAR_COLLAPSE = 'sidebar-collapse';
    const LAYOUT_BOXED = 'layout-boxed';
    const LAYOUT_TOP_NAV = 'layout-top-nav';

    /**
     * Skins.
     */
    const SKIN_BLUE = 'skin-blue';
    const SKIN_BLUE_LIGHT = 'skin-blue-light';
    const SKIN_YELLOW = 'skin-yellow';
    const SKIN_YELLOW_LIGHT = 'skin-yellow-light';
    const SKIN_GREEN = 'skin-green';
    const SKIN_GREEN_LIGHT = 'skin-green-light';
    const SKIN_PURPLE = 'skin-purple';
    const SKIN_PURPLE_LIGHT = 'skin-purple-light';
    const SKIN_RED = 'skin-red';
    const SKIN_RED_LIGHT = 'skin-red-light';
    const SKIN_BLACK = 'skin-black';
    const SKIN_BLACK_LIGHT = 'skin-black-light';

    /**
     * Sidebar menu config.
     *
     * @var array
     */
    public static $mainMenuConfig = [];

    /**
     * Admin layout type.
     *
     * @var string
     */
    public static $bodyLayout = self::LAYOUT_SIDEBAR_MINI;

    /**
     * Admin layout theme. By default are used blue skin.
     *
     * @var string
     */
    public static $skin = self::SKIN_BLUE;

    /**
     * AssetBundle config.
     *
     * @var null|array|string
     */
    public static $assetBundleConfig = null;

    /**
     * Home URL.
     *
     * @var string
     */
    public static $homeUrl = '/';

    /**
     * An array of extra asset. Each asset can be specified one of the following format:
     * - a string thar represent a class name of extra asset;
     * - an array that must contain a class key and may contain other settings of asset bundle.
     *
     * @see BaseYii::createObject()
     *
     * @var array
     */
    public static $extraAssets = [];

    /**
     * This array contain a key->value pairs where key - is link name and value is link
     * that will be rendered in "user-body" section of menu.
     *
     * @var string[]
     */
    public static $userBody = [];



    /**
     * Company name.
     *
     * @var string
     */
    public static $companyName = '';

    /**
     * Short company name.
     *
     * @var string
     */
    public static $shotCompanyName = '';

    /**
     * Link to user profile.
     *
     * @var string
     */
    public static $profileLink = '/profile';

    /**
     * Link to sign-out action.
     *
     * @var string
     */
    public static $signOutLink = '/site/logout';

}
