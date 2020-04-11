<?php

/**
 * @copyright Copyright &copy; Samir IZZA 2020 SIGNA Web Solutions
 * @package yii2-modal-login
 * @version 1.0
 */

namespace signa\modallogin;

/**
 * Generate a button that will open a login form in a bootstrap4 modal window
 *
 * @author Samir IZZA <samirmember@gmail.com>
 * @since 1.0
 */
class ModalLoginAsset extends \yii\web\AssetBundle {

    public $sourcePath = '@signa/yii2-modal-login/assets';

    // public $baseUrl = '@web';
    
    public $css = [
        'modal-login.css',
    ];

    public $js = [
    	'modal-login.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}