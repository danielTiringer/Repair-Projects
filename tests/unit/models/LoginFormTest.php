<?php

namespace tests\unit\models;

use app\models\LoginForm;
use app\tests\fixtures\UserFixture;
use Codeception\Test\Unit;
use Yii;

class LoginFormTest extends Unit
{
    private $model;

    public function _fixtures()
    {
        return [
            'profiles' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ];
    }

    protected function _after()
    {
        Yii::$app->user->logout();
    }

    public function testLoginNoEmail()
    {
        $this->model = new LoginForm([
            'email' => 'not_existing_email',
            'password' => 'not_existing_password',
        ]);

        expect_not($this->model->login());
        expect_that(Yii::$app->user->isGuest);
    }

    public function testLoginWrongPassword()
    {
        $this->model = new LoginForm([
            'email' => 'demo@test.com',
            'password' => 'wrong_password',
        ]);

        expect_not($this->model->login());
        expect_that(Yii::$app->user->isGuest);
        expect($this->model->errors)->hasKey('password');
    }

    public function testLoginCorrect()
    {
        $this->model = new LoginForm([
            'email' => 'demo@test.com',
            'password' => 'password',
        ]);

        expect_that($this->model->login());
        expect_not(Yii::$app->user->isGuest);
        expect($this->model->errors)->hasntKey('password');
    }

}
