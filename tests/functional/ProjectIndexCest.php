<?php

use app\tests\fixtures\ProjectFixture;
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
            'projects' => [
                'class' => ProjectFixture::class,
                'dataFile' => codecept_data_dir() . 'project.php',
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
        $I->seeLink(Yii::t('app', 'Create Project'), '/create');
        $I->see(Yii::t('app', 'Projects'), 'h1');
        $I->seeNumberOfElements('tr', 3);
        $I->seeLink(Yii::t('app', 'Make'));
        $I->seeLink(Yii::t('app', 'Model'));
        $I->seeLink(Yii::t('app', 'Description'));
        $I->seeLink(Yii::t('app', 'Year'));
        $I->seeLink(Yii::t('app', 'Source'));
        $I->seeLink(Yii::t('app', 'Status'));
        $I->see('1', 'td');
        $I->see('Test_Make', 'td');
        $I->see('Test_Model', 'td');
        $I->see('Test_Description', 'td');
        $I->see('2020', 'td');
        $I->see('Ebay', 'td');
        $I->see('In Progress', 'td');
    }

    public function navigateToNewProjectForm(FunctionalTester $I)
    {
        $I->click(Yii::t('app', 'Create Project'));
        $I->seeCurrentUrlEquals('/index-test.php/project/create');
    }
}
