<?php 

use app\tests\fixtures\ProjectFixture;
use app\tests\fixtures\UserFixture;

class ProjectUpdateCest
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
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('demo'));
        $I->amOnPage(['project/update?id=1']);
    }

    public function cannotOpenProjectUpdateBeforeLogin(FunctionalTester $I)
    {
        Yii::$app->user->logout();
        $I->amOnPage(['project/update?id=1']);
        $I->see(Yii::t('app', 'Login'), 'h1');
    }

    public function openProjectUpdate(FunctionalTester $I)
    {
        $I->amOnPage(['project/update?id=1']);

        $I->seeInTitle(Yii::t('app', 'Update Project') . ': 1');
        $I->see(Yii::t('app', 'Update Project') . ': 1', 'h1');
        $I->see(Yii::t('app', 'Make'), 'label');
        $I->see(Yii::t('app', 'Model'), 'label');
        $I->see(Yii::t('app', 'Year'), 'label');
        $I->see(Yii::t('app', 'Code'), 'label');
        $I->see(Yii::t('app', 'Description'), 'label');
        $I->see(Yii::t('app', 'Price'), 'label');
        $I->see(Yii::t('app', 'Source'), 'label');
        $I->see(Yii::t('app', 'Save'), 'button');
        $I->seeInFormFields('#project-form', [
            'Project[make]' => 'Test_Make',
            'Project[model]' => 'Test_Model',
            'Project[year]' => '2020',
            'Project[code]' => 'Test_Code',
            'Project[price]' => '100',
            'Project[source]' => 'Ebay',
        ]);
    }

    public function updateProjectRedirectsAndDataPersists(FunctionalTester $I)
    {
        $I->amOnPage(['project/update?id=1']);

        $I->selectOption('Project[source]', 'Jofogas');

        $I->click(Yii::t('app', 'Save'));
        $I->seeCurrentUrlEquals('/index-test.php/project/view?id=1');
        $I->see('Jofogas', 'td');
    }
}
