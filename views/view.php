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
    // 'title' => Yii::t('mlogin', 'Details'),
    // 'title' => '<h5 class="modal-title w-100 text-center">' . Yii::t('app', 'Détails') .'</h5>',
    // 'title' => '<h5 id="modal-window-label" class="modal-title">' . Yii::t('app', 'Détails') .'</h5>',
    'title' => '',
    'options' => [
    	'tabindex' => ''
    ],
]);
echo "<div id='modalContent'></div>";
Modal::end();

echo Html::a($label, null, $options);

echo Html::tag('div', $formId, ['id' => 'login-form-id', 'class' => 'd-none']);