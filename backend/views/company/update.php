<?php

use backend\models\Client;
use backend\models\Company;
use yii\web\View;

/* @var  View $this*/
/* @var  Company $model*/

$this->title = Yii::t('admin', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div class="company-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
