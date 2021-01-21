<?php


use backend\components\enums\RoutesEnum;
use backend\helpers\CompanyHelper;
use backend\models\Company;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Company $model
 */

$form = ActiveForm::begin();

?>

<?= $form->field($model, 'title') ?>

<?= $form->field($model, 'clientIds')->widget(Select2::class, [
        'theme' => Select2::THEME_KRAJEE_BS4,
    'options' => ['multiple' => true],
    'initValueText' => $model->makeInitTextForSelect2ClientIds($model->clientIds),
    'pluginOptions' => [
        'placeholder' => Yii::t('admin', 'Select') . '...',
        'minimumInputLength' => 3,
        'ajax' => [
            'url' => Url::to([RoutesEnum::CLIENT_LIST_FOR_SELECT2]),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
    ]
]); ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-primary']) ?>
</div>
<? ActiveForm::end(); ?>
