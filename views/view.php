<?php
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use signa\modallogin\ModalLoginAsset;

ModalLoginAsset::register($this);

Modal::begin([
    'id' => 'modal-window',
    'size' => 'modal-xs',
    'headerOptions' => [
    	'class' => 'bg-default'
    ],
    'title' => Yii::t('mlogin', 'Details'),
    'options' => [
    	'tabindex' => ''
    ],
]);
echo "<div id='modalContent'></div>";
Modal::end();

echo Html::a($label, null, $options);

echo Html::tag('div', $formId, ['id' => 'login-form-id', 'class' => 'd-none']);