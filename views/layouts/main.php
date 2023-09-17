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
        <div class="header-area">
            <div class="header-top_area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_top_wrap d-flex justify-content-between align-items-center">
                                <a href="/site/about" class="logo">
                                    <img src="/web/img/logo.png" width="100" height="50" alt="teacher journal"/>
                                </a>
                                <div class="text_wrap">
                            
                                    <?= !Yii::$app->user->isGuest ? '<p>' .
                                       '<i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                       <span class="ml-1">'. Yii::$app->user->identity->login .'</span>'.
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
            $viewing = Yii::$app->user->can('canViewMarksAndAttendance') ? '<li><a href="/viewing/default/">Просмотр успеваемости</a></li>' : '';
            
            ?>
            

            <?= !Yii::$app->user->isGuest ?
                '<div id="sticky-header" class="main-header-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="header_wrap d-flex justify-content-between align-items-center">
                                    <div class="header_left">
                                    </div>
                                    <div class="header_right d-flex align-items-center">
                                        <div class="main-menu d-lg-block">
                                            <nav>
                                                <ul id="navigation">'
                                                    . $admin
                                                    . $teaching
                                                    . $adding
                                                    . $manage 
                                                    . $viewing .
                                                '</ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>' : '';
            ?>
        </div>
    </header>

    <div class="mb-4">
        <?= $content ?>
    </div>

    <footer id="footer" class="footer mt-auto py-3 mt-3">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; АИС Электронный журнал преподавателя <?= date('Y') ?></div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
