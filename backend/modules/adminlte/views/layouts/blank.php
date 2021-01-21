<?php

/* @var View $this */

/* @var string $content */

use backend\modules\adminlte\assets\AdminLteAsset;
use backend\components\enums\ViewParamsEnum;
use yii\helpers\Html;
use yii\web\View;

AdminLteAsset::register($this);
$bodyClass = $this->params[ViewParamsEnum::BODY_CLASS] ?? 'blank';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= $bodyClass ?>">
<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
