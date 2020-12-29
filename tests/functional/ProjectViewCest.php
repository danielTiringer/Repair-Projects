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
}
