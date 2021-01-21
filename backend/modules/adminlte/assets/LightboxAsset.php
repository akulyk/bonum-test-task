<?php declare(strict_types=1);

namespace backend\modules\adminlte\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\web\YiiAsset;

/**
 * Class LightboxAsset
 * @package backend\modules\adminlte\assets
 */
class LightboxAsset extends AssetBundle
{

    public $sourcePath = '@vendor/almasaeed2010/adminlte';

    public $css = [
      'plugins/ekko-lightbox/ekko-lightbox.css'
    ];
    public $js = [
        'plugins/ekko-lightbox/ekko-lightbox.min.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END
    ];

    public $depends = [
      JqueryAsset::class,
    ];

}
