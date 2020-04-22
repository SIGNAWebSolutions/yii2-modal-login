<?php

/**
 * @copyright Copyright &copy; Samir IZZA, signawebsolutions.com, 2020
 * @package yii2-modal-login
 * @version 1.0.0
 */

namespace signa\modallogin;

use Yii;
use yii\web\View;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Make a button that open a Bootstrap4 Modal with the login form.
 *
 * @author Samir IZZA <samirmember@gmail.com>
 * @since 1.0
 * @see https://github.com/signawebsolutions/yii2-modal-login
 */
class ModalLogin extends Widget
{
    /**
     * Modal extra large size
     */
    const XL = 'xl';

    /**
     * Modal large size
     */
    const LARGE = 'lg';

    /**
     * Modal medium size
     */
    const MEDIUM = 'md';

    /**
     * Modal small size (default)
     */
    const SMALL = 'sm';

    /**
     * @var string Size of the Modal window, must be one of the [[ModalLogin::XL]],
     * [[ModalLogin::MEDIUM]] or [[ModalLogin::SMALL]].
     */
    public $size = self::MEDIUM;

    /**
     * @var array the HTML attributes for the button.
     */
	public $options = [];

    /**
     * @var array the URL to open in the modal form using the Url::to method.
     */
	public $url;

    /**
     * @var string the label of the button that open the modal window.
     */
	public $label;

    /**
     * @var string the header to show on the top of the modal window.
     */
	public $headerLabel;

    /*
     * Available events:
     * - `onLoginSuccess`: fire after the user login successfully and before closing the modal window.
     * - `onOpenModal`: fire when the modal window is opened.
     */
	public $events = [];

	/**
	 * @var string the ID of the login form. This is used to attach an event to the login form.
	 */
	public $loginFormId = 'login-form';

    /**
     * @inheritdoc
     */
	public function init()
	{
		parent::init();
        if ($this->url === null) {
            throw new InvalidConfigException(Yii::t('mlogin', 'The "url" property must be set.'));
        }
        if ($this->label === null) {
            throw new InvalidConfigException(Yii::t('mlogin', 'The "label" property must be set.'));
        }

        if (isset($this->events['onLoginSuccess'])) {
            $userEvent = $this->events['onLoginSuccess'];
            $this->view->registerJs(<<<JS
                document.addEventListener('onLoginSuccess', $userEvent);
            JS, View::POS_READY
            );
        }

        if (isset($this->events['onOpenModal'])) {
            $userEvent = $this->events['onOpenModal'];
            $this->view->registerJs(<<<JS
                document.addEventListener('onOpenModal', $userEvent);
            JS, View::POS_READY
            );
        }
	}

    /**
     * @inheritdoc
     */
    public function run()
    {
    	$options = [
		    'for' => ($this->headerLabel) ? $this->headerLabel : Yii::t('mlogin', 'Authentication'),
		    'url' => Url::to($this->url),
		];

		$options = ArrayHelper::merge($options, $this->options);

		$options['class'] = (isset($this->options['class'])) ? $this->options['class'] . ' modal-form' : 'modal-form';

		return $this->render('view', [
			'options' => $options,
			'label' => $this->label,
			'formId' => $this->loginFormId,
            'size' => $this->size,
		]);
    }

    public function afterRun($result)
    {
        $result = parent::afterRun($result);
        // code here
        return $result;
    }
}
