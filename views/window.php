<?php
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use signa\modallogin\ModalLoginAsset;

ModalLoginAsset::register($this);

Modal::begin([
    'id' => 'modal-window',
    'size' => 'modal-' . $size,
    'headerOptions' => [
    	'class' => 'bg-default'
    ],
    'title' => '',
    'options' => [
    	'tabindex' => ''
    ],
]);
echo "<div id='modalContent'></div>";
Modal::end();

echo Html::a($label, null, $options);

echo Html::tag('div', $contentId, ['id' => 'login-form-id', 'class' => 'd-none']);