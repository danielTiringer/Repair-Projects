<?php 

class ProjectCreateCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('demo'));
        $I->amOnPage(['project/create']);
    }

    public function openProjectCreatePage(\FunctionalTester $I)
    {
        $I->see(Yii::t('app', 'Create Project'), 'h1');
        $I->see(Yii::t('app', 'Make'), 'label');
        $I->see(Yii::t('app', 'Model'), 'label');
        $I->see(Yii::t('app', 'Year'), 'label');
        $I->see(Yii::t('app', 'Code'), 'label');
        $I->see(Yii::t('app', 'Description'), 'label');
        $I->see(Yii::t('app', 'Price'), 'label');
        $I->see(Yii::t('app', 'Source'), 'label');
        $I->see(Yii::t('app', 'Save'), 'button');
    }

    public function createProjectWithoutNecessaryData(FunctionalTester $I)
    {
        $I->submitForm('#project-form', []);
        $I->expectTo('see validation errors');
        $I->see(Yii::t('app', 'Make cannot be blank.'));
        $I->see(Yii::t('app', 'Model cannot be blank.'));
        $I->see(Yii::t('app', 'Year cannot be blank.'));
        $I->see(Yii::t('app', 'Price cannot be blank.'));
    }

    public function createProject(FunctionalTester $I)
    {
        $I->submitForm(
            '#project-form',
            [
                'Project[make]' => 'Test Make',
                'Project[model]' => 'Test Model',
                'Project[year]' => 2020,
                'Project[code]' => 'Test Code',
                'Project[description]' => 'Just adding some test description here',
                'Project[price]' => 5000,
                'Project[source]' => 1,
            ]
        );
        $I->dontSeeElement('form#project-form');
        $I->seeRecord('app\models\Project', ['make' => 'Test Make', 'model' => 'Test Model']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }
}
