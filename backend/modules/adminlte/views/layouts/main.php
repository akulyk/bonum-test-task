<?php

use backend\components\enums\RoutesEnum;
use backend\modules\adminlte\AdminView;
use backend\modules\adminlte\assets\AdminLteAsset;
use backend\modules\adminlte\assets\DefaultAsset;
use backend\modules\adminlte\widgets\TreeView;
use common\models\User;
use yii\helpers\Html;
use yii\web\View;
use backend\modules\adminlte\widgets\Alert;
use yii\widgets\Breadcrumbs;

/* @var View $this */
/* @var string $content */

AdminLteAsset::register($this);
DefaultAsset::register($this);

/**@var User $user */
$user = Yii::$app->user->getIdentity();
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
<body class="<?php echo AdminView::$skin ?> <?php echo AdminView::$bodyLayout ?>">
<?php $this->beginBody() ?>
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <?= Html::a(Yii::t('admin', 'Home'), [''], ['class' => 'nav-link']) ?>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav_item">
                <?= Html::a('<ion-icon name="log-out-outline"></ion-icon>', [RoutesEnum::LOGOUT],
                    ['data-method' => 'post', 'class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <?= Html::a(Html::tag('span', Yii::t('admin', 'Dashboard'), ['class' => 'brand-text font-weight-light']),
            [''], ['class' => 'brand-link']) ?>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?= Html::img('/img/default-user-avatar.png', ['alt' => 'User Image', 'class' => 'img-circle elevation-2']) ?>
                </div>
                <div class="info">
                    <?= Html::a($user->username, '#', ['class' => 'd-block']); ?>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <?= TreeView::widget() ?>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?= $this->title ?> </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => 'breadcrumb float-sm-right'],
                            'tag' => 'ol',
                            'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                            'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n"
                        ]);
                        ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?php //todo define if it needed ?>
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            <?= Yii::t('admin', 'Панель управления') ?>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2006-<?= date('Y') ?> <a href="https://meta.md" target="_blank">Meta.md</a>.</strong>
        All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
