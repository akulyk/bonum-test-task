<?php
use backend\components\enums\ViewParamsEnum;
use common\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

/* @var  View $this */
/* @var  ActiveForm $form */
/* @var  LoginForm $model */


$this->params[ViewParamsEnum::BODY_CLASS] = 'login-page';
$this->title = Yii::t('admin','Login');
?>
<div class="login-box">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=Yii::t('admin','Please fill out the following fields to login:');?></p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('admin','Login'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
</div>
