<?php

use backend\models\Client;
use backend\models\search\ClientSearch;
use \backend\modules\adminlte\components\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var ClientSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */
$this->title = Yii::t('admin', 'Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">
    <p>
        <?= Html::a(Yii::t('admin', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
            ],
            [
                'attribute' => 'company',
                'value' => static function (Client $client) {
                    return $client->getCompanyNamesList('<br>');

                },'format'=>'html',
            ],
            ['class' => 'backend\modules\adminlte\components\grid\ActionColumn'],

        ],
    ]); ?>
</div>
