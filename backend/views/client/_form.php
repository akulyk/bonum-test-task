<?php


use backend\components\enums\RoutesEnum;
use backend\helpers\ClientHelper;
use backend\models\Client;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Client $model
 */

$form = ActiveForm::begin();

?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'companyIds')->widget(Select2::class, [
    'options' => ['multiple' => true],
    'initValueText' => $model->makeInitTextForSelect2CompanyIds($model->companyIds),
    'pluginOptions' => [
        'placeholder' => Yii::t('admin', 'Select') . '...',
        'minimumInputLength' => 3,
        'ajax' => [
            'url' => Url::to([RoutesEnum::COMPANY_LIST_FOR_SELECT2]),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
    ]
]); ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-primary']) ?>
</div>
<? ActiveForm::end(); ?>
