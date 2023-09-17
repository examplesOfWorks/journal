<?php

use app\models\Organization;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\OrganizationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Панель управления'; ?>

<div class="admin-default-index">
    <section role="main" class="content-body">
        <header class="page-header">
            <h2><?= $this->title ?></h2> 
			<div class="right-wrapper text-end">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="/admin/default/index">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li><span><?=$this->title?></span></li>

                    </ol>

                    <?= Html::a('<i class="fas fa-chevron-left"></i>', ['/admin/default/index'], ['class' => 'sidebar-right-toggle', 'data-open' => 'sidebar-right']) ?>
                </div>      
        </header>

        <div class="default-index">
            <h2><?= Html::encode($this->title) ?></h2>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-xl-4">
                            <section class="card card-featured-left card-featured-quaternary mb-3">
								<div class="card-body">
									<div class="widget-summary">
										<div class="widget-summary-col widget-summary-col-icon">
											<div class="summary-icon bg-quaternary">
												<i class="fas fa-user"></i>
											</div>
										</div>
										<div class="widget-summary-col">
											<div class="summary">
												<h4 class="title">Управление пользователями</h4>
											</div>
											<div class="summary-footer">
												<!-- <a class="text-muted text-uppercase" href="/admin/admin/index">перейти...</a> -->
												<?= Html::a('Перейти...', ['/admin/user'], ['class' => 'text-muted text-uppercase']) ?>
											</div>
										</div>
									</div>
								</div>
							</section>
                        </div>
                        <div class="col-xl-4">
                            <section class="card card-featured-left card-featured-primary mb-3">
							    <div class="card-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="bx bx-collection"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Управление отделениями</h4>
                                                <div class="info">
                                                    
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <!-- <a class="text-muted text-uppercase" href="/admin/admin/educational-process">перейти...</a> -->
												<?= Html::a('Перейти...', ['/admin/department'], ['class' => 'text-muted text-uppercase']) ?>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-4">
                            <section class="card card-featured-left card-featured-secondary">
								<div class="card-body">
									<div class="widget-summary">
										<div class="widget-summary-col widget-summary-col-icon">
											<div class="summary-icon bg-secondary">
                                                <i class="bx bx-detail"></i>
											</div>
										</div>
										<div class="widget-summary-col">
											<div class="summary">
												<h4 class="title">Управление специальностями</h4>
											</div>
											<div class="summary-footer">
												<?= Html::a('Перейти...', ['/admin/specialty'], ['class' => 'text-muted text-uppercase']) ?>
											</div>
										</div>
									</div>
								</div>
							</section>
                        </div>
                    </div>
                </div>
            </div>

            
		</div>
    </section>
</div>
