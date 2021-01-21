<?php

use backend\models\Client;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var  View $this */
/* @var Client $model */
/* @var string $language */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="testimonial-view">
    <p>
        <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('admin', 'Are you sure?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'company',
                'value' => static function (Client $client) {
                if(!$companies = $client->companies){
                    return null;
                }
                $data = [];
                foreach ($companies as $company)
                {
                    $data[] = Html::a($company->title,['/company/view','id'=>$company->id]);
                }
                return implode(';&nbsp;&nbsp;',$data);
            },'format'=>'html'
            ],
        ],
    ]) ?>

</div>
