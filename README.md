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
]) ?>
```

In your user controller, here is an example on how to use the actionLogin method:

```php
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->response->format = 'json';
            return [
            	'success' => true,
            	// pass other data here that you can retrieve in the onLoginSuccess
            ];
        } else {
            if ($model->errors) {
                Yii::$app->response->format = 'json';
                return $model->errors;
            }
            $model->password = '';

            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('login', [
                    'model' => $model,
                ]);
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
```

You can customize this action to fit your project.

If you don't see errors on the modal window, think to add the error summary function inside your form:
```php
<?= $form->errorSummary($model) ?>
```