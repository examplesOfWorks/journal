<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

MainAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
        <div class="header-area ">
            <div class="header-top_area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_top_wrap d-flex justify-content-between align-items-center">
                                <div class="text_wrap">
                                    <p><span>+880166 253 232</span> <span>info@domain.com</span></p>
                                </div>
                                <div class="text_wrap">
                                    <?= !Yii::$app->user->isGuest ? '<p>' .
                                        Html::a('Выход', ['/site/logout'], [
                                            'class' => 'ti-user logout',
                                            ]) . '</p>' : '' 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
            $admin = Yii::$app->user->can('canAdmin') ? '<li><a href="/admin/default/">Панель управления</a></li>' : '';
            $teaching = Yii::$app->user->can('canTeaching') ? '<li><a href="/teacher/default/index">Электронный журнал</a></li>' : '';
            $adding = Yii::$app->user->can('canAddInfo') ? '<li><a href="/adding/default">Добавление данных</a></li>' : '';
            $manage = Yii::$app->user->can('canManageProcess') ? '<li><a href="/manage/default/">Управление учебным процессом</a></li>' : '';
            ?>

            <?= !Yii::$app->user->isGuest ?
                '<div id="sticky-header" class="main-header-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="header_wrap d-flex justify-content-between align-items-center">
                                    <div class="header_left">
                                        <div class="logo">
                                            <a href="index.html">
                                                <!-- <img src="img/logo.png" alt=""> -->
                                            </a>
                                        </div>
                                    </div>
                                    <div class="header_right d-flex align-items-center">
                                        <div class="main-menu  d-none d-lg-block">
                                            <nav>
                                                <ul id="navigation">'
                                                    . $admin
                                                    . $teaching
                                                    . $adding
                                                    . $manage .
                                                '</ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>' : '';
            ?>
        </div>
    </header>

    <?= $content ?>

    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; АИС Электронный журнал преподавателя <?= date('Y') ?></div>
                <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
