<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
use yii\bootstrap5\Html;

MainAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>" class="no-js" lang="zxx">

    <head>

    <?php $this->head() ?>
        <!-- Basic -->
        <meta charset="UTF-8">

        <title><?= $this->title ?></title>
        
        <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">    -->

    </head>

    <?php $this->beginBody() ?>
    <body>
        <!-- header-start -->
    <header>
        <div class="header-area ">
            <div class="header-top_area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_top_wrap d-flex justify-content-between align-items-center">
                                <div class="logo-container">
                                    <a href="/site/about" class="logo">
                                        <img src="/web/img/logo.png" width="100" height="50" alt="logo" />
                                    </a>
                                </div>
                                <div class="text_wrap">
                                    <p><i class="ti-user"></i> <?= Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ?>: <?= Yii::$app->user->identity->login ?> <?= Html::a('Выход', ['/teacher/default/logout']) ?></p>

                                </div>
								
							</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <?= $content ?>

    </body>
    <?php $this->endBody() ?>
    
</html>
<?php $this->endPage() ?>

