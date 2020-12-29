<?php

use app\tests\fixtures\UserFixture;

class ProjectIndexCest
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

    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('demo'));
        $I->amOnPage(['project']);
    }

    public function cannotOpenProjectPageBeforeLogin(FunctionalTester $I)
    {
        Yii::$app->user->logout();
        $I->amOnPage(['project']);
        $I->see(Yii::t('app', 'Login'), 'h1');
    }

    public function openProjectPage(FunctionalTester $I)
    {
        $I->seeInTitle(Yii::t('app', 'Projects'));
        $I->see(Yii::t('app', 'Projects'), 'h1');
        $I->see(Yii::t('app', 'Create Project'), 'a');
        $I->see(Yii::t('app', 'Make'), 'a');
        $I->see(Yii::t('app', 'Model'), 'a');
        $I->see(Yii::t('app', 'Description'), 'a');
        $I->see(Yii::t('app', 'Year'), 'a');
        $I->see(Yii::t('app', 'Source'), 'a');
        $I->see(Yii::t('app', 'Status'), 'a');
    }

    public function navigateToNewProjectForm(FunctionalTester $I)
    {
        $I->click(Yii::t('app', 'Create Project'));
        $I->see(Yii::t('app', 'Create Project'), 'h1');
    }
}
