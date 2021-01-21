<?php

use yii\base\Model;
use yii\helpers\Html;
use yii\web\View;
use backend\modules\adminlte\assets\bootstrap\SwitchCheckboxAsset;

/**
 * @var View $this
 * @var Model $model
 * @var string $attribute
 * @var string $offColor
 * @var string $onColor
 * @var string $offText
 * @var string $onText
 * @var string $labelText
 */
SwitchCheckboxAsset::register($this);
$this->registerJs(' $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch(\'state\', $(this).prop(\'checked\'));
    });',View::POS_READY,'bootstrap-switch')
?>

<?php echo Html::activeCheckbox($model,$attribute,[
    'data'=>[
        'bootstrap-switch'=>'',
        'off-color'=>$offColor,
        'on-color'=>$onColor,
        'on-text'=>$onText,
        'off-text'=>$offText,
        'label-text'=>$labelText
    ],
    'label'=>false
]);?>


