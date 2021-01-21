<?php declare(strict_types=1);

namespace backend\modules\adminlte\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\View;
use yii\web\YiiAsset;

/**
 * Class AdminLteAsset
 * @package backend\components\adminlte\assets
 */
class AdminLteAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/almasaeed2010/adminlte';
    /**
     * @var string
     */
    public $skin = '_all-skins';

    /**
     * @var array
     */
    public $css = [
        'plugins/fontawesome-free/css/all.min.css',
        'dist/css/adminlte.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
    ];

    /**
     * @var array
     */
    public $js = [
        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        'dist/js/adminlte.min.js',
    ];

    /**
     * @var array
     */
    public $jsOptions = [
        'position' => View::POS_END
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        IonIconsAsset::class,
    ];
}
