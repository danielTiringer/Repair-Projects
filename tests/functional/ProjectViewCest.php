<?php

use app\tests\fixtures\ProjectFixture;
use app\tests\fixtures\UserFixture;

class ProjectViewCest
{
    public function _fixtures()
    {
        return [
            'profiles' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
            'projects' => [
                'class' => ProjectFixture::class,
                'dataFile' => codecept_data_dir() . 'project.php',
            ]
        ];
    }

    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('demo'));
        $I->amOnPage(['project/create']);
    }

    public function cannotOpenProjectViewBeforeLogin(\FunctionalTester $I)
    {
        Yii::$app->user->logout();
        $I->amOnPage(['project/view?id=1']);
        $I->see(Yii::t('app', 'Login'), 'h1');
    }

    public function openProjectView(\FunctionalTester $I)
    {
        $I->amOnPage(['project/view?id=1']);

        $I->see('Test_Make Test_Model', 'h1');
        $I->see(Yii::t('app', 'Update'), 'a');
        $I->see(Yii::t('app', 'Delete'), 'a');
        $I->see(Yii::t('app', 'Upload Images'), 'a');
        $I->see(Yii::t('app', 'ID'), 'th');
        $I->see(Yii::t('app', '1'), 'td');
        $I->see(Yii::t('app', 'Make'), 'th');
        $I->see('Test_Make', 'td');
        $I->see(Yii::t('app', 'Model'), 'th');
        $I->see('Test_Model', 'td');
        $I->see(Yii::t('app', 'Year'), 'th');
        $I->see('2020', 'td');
        $I->see(Yii::t('app', 'Code'), 'th');
        $I->see('Test_Code', 'td');
        $I->see(Yii::t('app', 'Description'), 'th');
        $I->see('Test_Description', 'td');
        $I->see(Yii::t('app', 'Price'), 'th');
        $I->see('100', 'td');
        $I->see(Yii::t('app', 'Source'), 'th');
        $I->see('Ebay', 'td');
        $I->see(Yii::t('app', 'Status'), 'th');
        $I->see('In Progress', 'td');
        $I->see(Yii::t('app', 'Created By'), 'th');
        $I->see(Yii::t('app', 'Created At'), 'th');
        $I->see(Yii::t('app', 'Updated By'), 'th');
        $I->see(Yii::t('app', 'Updated At'), 'th');
    }
}
