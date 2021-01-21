<?php

use backend\models\Company;
use yii\web\View;


/* @var  View $this*/
/* @var Company $model */

$this->title = Yii::t('admin', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
