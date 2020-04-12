Bootstrap4 Modal Form
=====================
Make a button that open a Bootstrap4 Modal with the login form

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require --prefer-dist signawebsolutions/yii2-modal-login "*"
```

or add

```
"signawebsolutions/yii2-modal-login": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \signa\modallogin\ModalLogin::widget([
    'label' => Yii::t('app', 'Login'),
    'url' => ['/user/login'],
    'loginFormId' => 'login-form',
    'options' => [
        'class' => 'btn',
    ],
    'events' => [
        'onLoginSuccess' => 'function (e) {
            console.log(e.detail);
        }',
    ],
]) ?>```