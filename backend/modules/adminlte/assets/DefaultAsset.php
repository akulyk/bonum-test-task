<?php declare(strict_types=1);

namespace backend\modules\adminlte\assets;

use yii\web\AssetBundle;


/**
 * Class DefaultAsset
 * @package backend\modules\adminlte\assets
 */
class DefaultAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@app/modules/adminlte/resources';

    /**
     * @var array
     */
    public $css = [
        'default.css',
    ];

}
