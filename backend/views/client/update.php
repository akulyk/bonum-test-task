<?php

use backend\models\Client;
use yii\web\View;

/* @var  View $this*/
/* @var  Client $model*/

$this->title = Yii::t('admin', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div class="client-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
