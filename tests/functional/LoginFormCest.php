<?php

use app\tests\fixtures\UserFixture;

class LoginFormCest
{
    public function _fixtures()
    {
        return [
            'profiles' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ];
    }


    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see(Yii::t('app', 'Login'), 'h1');

    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I)
    {
        $I->amLoggedInAs(100);
        $I->amOnPage('/');
        $I->see(Yii::t('app', 'Logout') . ' (admin)');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
        $I->amOnPage('/');
        $I->see(Yii::t('app', 'Logout') . ' (admin)');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see(Yii::t('app', 'Email cannot be blank.'));
        $I->see(Yii::t('app', 'Password cannot be blank.'));
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[email]' => 'admin@example.com',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect email or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[email]' => 'admin@example.com',
            'LoginForm[password]' => 'password',
        ]);
        $I->see(Yii::t('app', 'Logout') . ' (admin)');
        $I->dontSeeElement('form#login-form');              
    }
}
