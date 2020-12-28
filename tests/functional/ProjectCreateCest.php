<?php 

class ProjectCreateCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('demo'));
        $I->amOnPage(['project/create']);
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
}
