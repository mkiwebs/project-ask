<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use yii\helpers\Url;
AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-black  sidebar-mini">
<div class="wrapper">
<?php $this->beginBody() ?>
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?= Yii::$app->name ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?= Yii::$app->name ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
          <?php

            if (!Yii::$app->user->isGuest) {
          ?>

              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?=  Yii::$app->user->identity->username;?></span>
              </a>
            <?php  
              } // else {
              //     die("You must login to continue");
              // }

            ?>

            
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li class="">
              
                   <?= Html::a(
                       'Sign out ',
                       ['/site/logout'],
                       //['data-method' => 'post', 'class' => 'btn btn-danger btn-flat']
                       ['data-method' => 'post', 'class' => ' btn btn-danger btn-flat glyphicon glyphicon-log-out',
                       'confirm' => 'Sure  to exit?',]
                   ) ?>
           </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
<?= \app\components\SidebarWidget::widget(); ?>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
     <?= $content ?>
   </section>
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>&copy; Lyfey  <?= date('Y') ?><a href="http://ovicko.com">Ovicko Inc</a>.</strong> All rights
    reserved.
  </footer>
</div>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
