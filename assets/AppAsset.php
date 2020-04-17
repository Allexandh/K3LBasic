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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        //'css/font-face.css',
        //'vendor/font-awesome-4.7/css/font-awesome.min.css',
        //'vendor/font-awesome-5/css/fontawesome-all.min.css',
        //'vendor/mdi-font/css/material-design-iconic-font.min.css',
        //'vendor/bootstrap-4.1/bootstrap.min.css',
        //'vendor/animsition/animsition.min.css',
        //'vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css',
        //'vendor/wow/animate.css',
        //'vendor/css-hamburgers/hamburgers.min.css',
        //'vendor/slick/slick.css',
        //'vendor/select2/select2.min.css',
        //'vendor/perfect-scrollbar/perfect-scrollbar.css',
        //'css/theme.css',

    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
