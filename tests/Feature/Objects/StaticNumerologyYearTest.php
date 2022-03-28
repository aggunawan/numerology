<?php

namespace Tests\Feature\Objects;

use App\Objects\StaticNumerology;
use Tests\TestCase;

class StaticNumerologyYearTest extends TestCase
{
    private $numerology;

    protected function setUp(): void
    {
        parent::setUp();
        $this->numerology = new StaticNumerology(8, 11, 1982, 2022);
    }

    public function testGetDayMaster()
    {
        self::assertSame([9, 11], $this->numerology->getDayMaster()->getTraitCodes());
    }

    public function testGetCulture()
    {
        self::assertSame([8, 19], $this->numerology->getCulture()->getTraitCodes());
    }

    public function testGetEducation()
    {
        self::assertSame([1, 19], $this->numerology->getEducation()->getTraitCodes());
    }

    public function testGetMindset()
    {
        self::assertSame([1, 15], $this->numerology->getMindset()->getTraitCodes());
    }

    public function testGetBelief()
    {
        self::assertSame([2, 4, 12], $this->numerology->getBelief()->getTraitCodes());
    }

    public function testGetCareer()
    {
        self::assertSame([9, 16, 5], $this->numerology->getCareer()->getTraitCodes());
    }

    public function testGetPartner()
    {
        self::assertSame([11, 12], $this->numerology->getPartner()->getTraitCodes());
    }

    public function testGetAmbition()
    {
        self::assertSame([8, 17], $this->numerology->getAmbition()->getTraitCodes());
    }

    public function testGetTalents()
    {
        self::assertSame([3, 19, 15], $this->numerology->getTalent()->getTraitCodes());
    }

    public function testGetBusiness()
    {
        self::assertSame([10, 4, 6], $this->numerology->getBusiness()->getTraitCodes());
    }

    public function testGetIntellectual()
    {
        self::assertSame([18, 10, 6], $this->numerology->getIntellectual()->getTraitCodes());
    }

    public function testGetSpiritual()
    {
        self::assertSame([12, 8, 3], $this->numerology->getSpiritual()->getTraitCodes());
    }

    public function testGetEmotional()
    {
        self::assertSame([14, 9], $this->numerology->getEmotional()->getTraitCodes());
    }

    public function testGetSocial()
    {
        self::assertSame([18, 21], $this->numerology->getSocial()->getTraitCodes());
    }

    public function testGetRelationship()
    {
        self::assertSame([6, 7, 3], $this->numerology->getRelationship()->getTraitCodes());
    }

    public function testGetFinancial()
    {
        self::assertSame([14, 6, 12], $this->numerology->getFinancial()->getTraitCodes());
    }

    public function testGetSon()
    {
        self::assertSame([20, 17, 21], $this->numerology->getSon()->getTraitCodes());
    }

    public function testGetDaughter()
    {
        self::assertSame([13, 2, 6], $this->numerology->getDaughter()->getTraitCodes());
    }

    public function testGetCharacter()
    {
        self::assertSame([4, 2, 10, 3], $this->numerology->getCharacter()->getTraitCodes());
    }

    public function testGetHealth()
    {
        self::assertSame([5, 8, 14, 11], $this->numerology->getHealth()->getTraitCodes());
    }

    public function testGetPhysical()
    {
        self::assertSame([11, 20, 17], $this->numerology->getPhysical()->getTraitCodes());
    }

    public function testGetGoal()
    {
        self::assertSame([19, 16, 19], $this->numerology->getGoal()->getTraitCodes());
    }
}
