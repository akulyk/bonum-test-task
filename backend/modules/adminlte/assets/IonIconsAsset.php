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
class IonIconsAsset extends AssetBundle
{

    /**
     * @var array
     */
    public $js = [
        'https://unpkg.com/ionicons@5.0.0/dist/ionicons.js',
    ];

    /**
     * @var array
     */
    public $jsOptions = [
        'position' => View::POS_END
    ];

}
