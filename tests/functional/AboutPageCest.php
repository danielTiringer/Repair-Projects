<?php

class AboutPageCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['site/about']);
    }

    public function openAboutPage(FunctionalTester $I)
    {
        $I->seeInTitle(Yii::t('app', 'About'));
        $I->see(Yii::t('app', 'About'), 'h1');
        $I->see(Yii::t('app', 'We repair laptops and mobile phones for the pleasure of tinkering.'), 'p');
    }
}
