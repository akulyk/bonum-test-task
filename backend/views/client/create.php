<?php

use backend\models\Client;
use yii\web\View;


/* @var  View $this*/
/* @var Client $model */

$this->title = Yii::t('admin', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
