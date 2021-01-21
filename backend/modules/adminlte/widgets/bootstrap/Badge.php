<?php declare(strict_types=1);
namespace backend\modules\adminlte\widgets\bootstrap;

use common\widgets\BaseViewWidget;
use yii\base\Model;
use yii\helpers\Html;

class Badge extends BaseViewWidget{

    public string $content;
    public string $type;

    public function run()
    {
        return Html::tag('span',$this->content,['class'=>['badge','badge-'.$this->type]]);
    }
}
