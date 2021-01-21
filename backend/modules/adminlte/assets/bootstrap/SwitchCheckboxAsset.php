<?php declare(strict_types=1);

namespace backend\modules\adminlte\assets\bootstrap;

use backend\modules\adminlte\assets\AdminLteAsset;
use yii\web\AssetBundle;
use yii\web\View;

class SwitchCheckboxAsset extends AssetBundle
{

    public $sourcePath = '@vendor/almasaeed2010/adminlte';

    public $css = [];
    public $js = [
        'plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END
    ];

    public $depends = [
      AdminLteAsset::class,
    ];



}
