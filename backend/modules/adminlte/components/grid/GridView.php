<?php declare(strict_types=1);

namespace backend\modules\adminlte\components\grid;


class GridView extends \yii\grid\GridView {
   public $pager = [
       'linkContainerOptions' => ['class' => 'paginate_button page-item'],
       'linkOptions' => ['class' => 'page-link'],
       'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link', 'href' => '#'],
   ];
}
