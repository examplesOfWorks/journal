<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AdminAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;


AdminAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>" class="fixed">
	<head>

    <?php $this->head() ?>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?= $this->title ?></title>
		

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->

		<!-- <link rel="stylesheet" href="https://kit.fontawesome.com/dcc3ffb872.css" crossorigin="anonymous"> -->

		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">



        

	</head>
	<?php $this->beginBody() ?>

	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">

				<div class="logo-container">
					<a href="../4.0.0" class="logo">
						<img src="/web/img/logo.png" width="100" height="50" alt="Porto Admin" />
					</a>

					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>

				</div>

				<!-- start: search & user box -->
				<div class="header-right">

					<span class="separator"></span>

					<div id="userbox" class="userbox">
						<div class="profile-info">
							<span class="name"><?= Yii::$app->user->identity->login ?></span>
							<span class="role"><?= Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ?></span>
						</div>
						<a href="/admin/default/logout"><div class="profile-info"><span class="name"><b>Выход</b></span></div></a>

					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

				    <div class="sidebar-header">
				        <div class="sidebar-title">
				            Навигация
				        </div>
				        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>

				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">

				                <ul class="nav nav-main">
				                    <li>
				                        <a class="nav-link" href="/admin/default/index">
											<i class="bx bx-home-alt" aria-hidden="true"></i>
				                            <span>Панель управления</span>
				                        </a>                        
				                    </li>
									<li class="nav-link">
				                        <a class="nav-link" href="/adding/default">
											<i class="fas fa-plus" aria-hidden="true"></i>
				                            <span>Добавление данных</span>
				                        </a>
				                    </li>
									<li class="nav-link">
				                        <a class="nav-link" href="/manage/default/">
											<i class="fas fa-user" aria-hidden="true"></i>
				                            <span>Управление учебным процессом</span>
				                        </a>
				                    </li>
									
				                </ul>
				            </nav>

				            <hr class="separator" />

				        </div>

				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>

				    </div>

				</aside>
				<!-- end: sidebar -->
				
				<?= $content ?>
				
			</div>

		</section>

		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>