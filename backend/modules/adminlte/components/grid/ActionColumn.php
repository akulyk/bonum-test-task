<?php declare(strict_types=1);

namespace backend\modules\adminlte\components\grid;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn {
    public function init()
    {
        $this->header = $this->header ?: Yii::t('admin','Actions');
        $this->buttons = !empty($this->buttons)? $this->buttons :  [
            'view' => function ($url, $model) {
                return Html::a(
                    '<i class="fas fa-eye"></i>',
                    ['view', 'id' => $model->id],
                    );
            },
            'update' => function ($url, $model) {
                return Html::a(
                    '<i class="fas fa-pencil-alt"></i>',
                    ['update', 'id' => $model->id]
                    );
            },
            'delete' => function ($url, $model) {
                return Html::a(
                    '<i class="fas fa-trash-alt"></i>',
                    ['delete', 'id' => $model->id],
                    [
                        'data-confirm' => Yii::t('admin', 'Вы уверены, что хотите удалить эту запись?'),
                        'data-method' => 'post'
                    ]
                );
            },
        ];
        parent::init();

    }
}
