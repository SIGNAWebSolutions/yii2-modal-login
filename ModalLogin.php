<?php
/**
 * @copyright Copyright &copy; Samir IZZA, signawebsolutions.com, 2020
 * @package yii2-modal-login
 * @version 1.0.0
 */

namespace signa\modallogin;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Make a button that open a Bootstrap4 Modal with the login form.
 *
 * @author Samir IZZA <samirmember@gmail.com>
 * @since 1.0
 */
class ModalLogin extends Widget
{

    /**
     * @var array the HTML attributes for the button.
     * It can alo use these options
     *
     * - `class`: css classes of the button. We always add the modal-form class.
     * - `for`: head title of the modal window.
     * - `url`: the url to open in the modal window.
     */
	public $options = [];

	public $urlParams;

	public $url;

	public $label;

	public $headerLabel;


	public function init()
	{
		parent::init();
        if ($this->url === null) {
            throw new InvalidConfigException(Yii::t('mlogin', 'The "url" property must be set.'));
        }
        if ($this->label === null) {
            throw new InvalidConfigException(Yii::t('mlogin', 'The "label" property must be set.'));
        }

        ModalLoginAsset::register();
	}

    public function run()
    {
    	$options = [
		    'for' => ($this->headerLabel) ? $this->headerLabel : Yii::t('mlogin', 'Authentication'),
		    'url' => Url::to($this->url),
		];

		$options = ArrayHelper::merge($options, $this->options);
		$options['class'] = $this->options['class'] . ' modal-form';

		// var_dump($options);
		// exit;


    	return Html::a($this->label, null, $options);
    }
}
