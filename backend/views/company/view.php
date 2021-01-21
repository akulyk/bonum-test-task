<?php

use backend\models\Company;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var  View $this */
/* @var Company $model */
/* @var string $language */

$this->title = $model->title;
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
            'title',
            [
                'attribute' => 'company',
                'value' => static function (Company $company) {
                if(!$clients = $company->clients){
                    return null;
                }
                $data = [];
                foreach ($clients as $client)
                {
                    $data[] = Html::a($client->name,['/client/view','id'=>$client->id]);
                }
                return implode(';&nbsp;&nbsp;',$data);
            },'format'=>'html'
            ],
        ],
    ]) ?>

</div>
