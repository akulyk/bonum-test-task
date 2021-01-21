<?php

use backend\models\Company;
use backend\models\search\CompanySearch;
use \backend\modules\adminlte\components\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var CompanySearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */
$this->title = Yii::t('admin', 'Companies');
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
                'attribute' => 'title',
            ],
            [
                'attribute' => 'client',
                'value' => static function (Company $company) {
                    return $company->getClientNamesList('<br>');

                },'format'=>'html',
            ],
            ['class' => 'backend\modules\adminlte\components\grid\ActionColumn'],

        ],
    ]); ?>
</div>
