<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/main/';
    public $css = [
        'css/animate.css',
        'css/bootstrap.min.css',
        'css/flaticon.css',
        'css/font-awesome.min.css',
        'css/gijgo.css',
        'css/magnific-popup.css',
        'css/nice-select.css',
        'css/owl.carousel.min.css',
        'css/slicknav.css',
        'css/style.css',
        'css/theme-default.css',
        'css/themify-icons.css',
        'css/myStyles.css'
    ];
    public $js = [
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/owl.carousel.min.js',
        'js/isotope.pkgd.min.js',
        'js/ajax-form.js',
        'js/waypoints.min.js',
        'js/jquery.counterup.min.js',
        'js/imagesloaded.pkgd.min.js',
        'js/scrollIt.js',
        'js/jquery.scrollUp.min.js',
        'js/wow.min.js',
        'js/nice-select.min.js',
        'js/jquery.slicknav.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/plugins.js',
        'js/gijgo.min.js',
        'js/vendor/modernizr-3.5.0.min.js',
        'js/vendor/jquery-1.12.4.min.js',

        'js/contact.js',
        'js/jquery.ajaxchimp.min.js',
        'js/jquery.form.js',
        'js/jquery.validate.min.js',
        'js/mail-script.js',
    
        'js/main.js',

        'js/isotope.pkgd.min.js',
        'js/nice-select.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}