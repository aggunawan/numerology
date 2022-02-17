<?php

namespace Tests\Feature\Objects;

use App\Objects\StaticNumerology;
use Tests\TestCase;

class StaticNumerologyTest extends TestCase
{
    private $past;
    private $future;

    protected function setUp(): void
    {
        parent::setUp();
        $this->past = new StaticNumerology(20, 11, 1942);
        $this->future = new StaticNumerology(42, 18, 3912);
    }


    public function testGetDayMaster()
    {
        self::assertSame('Day Master', $this->past->getDayMaster()->getName());
        self::assertSame(1942, $this->past->getDayMaster()->getYear());
        self::assertSame((int) date('Y'), $this->future->getDayMaster()->getYear());

        self::assertSame(
            [
                2 => 'The High Priestess',
                17 => 'The Star'
            ],
            $this->past->getDayMaster()->getTraits()
        );

        self::assertSame(
            [
                3 => 'The Empress',
                14 => 'Temperance'
            ],
            $this->future->getDayMaster()->getTraits()
        );
    }

    public function testGetMindset()
    {
        self::assertSame('Mindset', $this->past->getMindset()->getName());
        self::assertSame(1957, $this->past->getMindset()->getYear());
        self::assertSame(2037, $this->future->getMindset()->getYear());

        self::assertSame(
            [
                4 => 'The Emperor',
                9 => 'The Hermit'
            ],
            $this->past->getMindset()->getTraits()
        );

        self::assertSame(
            [
                6 => 'The Lovers',
                8 => 'Strength'
            ],
            $this->future->getMindset()->getTraits()
        );
    }

    public function testGetEducation()
    {
        self::assertSame('Education', $this->past->getEducation()->getName());
        self::assertSame(1952, $this->past->getEducation()->getYear());
        self::assertSame(2032, $this->future->getEducation()->getYear());

        self::assertSame(
            [
                0 => 'The Fool',
                9 => 'The Hermit'
            ],
            $this->past->getEducation()->getTraits()
        );
        self::assertSame(
            [
                6 => 'The Lovers',
                16 => 'The Tower'
            ],
            $this->future->getEducation()->getTraits()
        );
    }

    public function testGetCulture()
    {
        self::assertSame('Culture', $this->past->getCulture()->getName());
        self::assertSame(1947, $this->past->getCulture()->getYear());
        self::assertSame(2027, $this->future->getCulture()->getYear());

        self::assertSame(
            [
                7 => 'The Chariot',
                15 => 'The Devil'
            ],
            $this->past->getCulture()->getTraits()
        );
        self::assertSame(
            [
                6 => 'The Lovers',
                12 => 'The Hanged Man'
            ],
            $this->future->getCulture()->getTraits()
        );
    }

    public function testGetSpiritual()
    {
        self::assertSame('Spiritual', $this->past->getSpiritual()->getName());
        self::assertSame(1997, $this->past->getSpiritual()->getYear());
        self::assertSame(2077, $this->future->getSpiritual()->getYear());

        self::assertSame(
            [
                12 => 'The Hanged Man',
                8 => 'Strength',
                10 => 'Wheel of Fortune',
            ],
            $this->past->getSpiritual()->getTraits()
        );
        self::assertSame(
            [
                18 => 'The Moon',
                0 => 'The Fool',
                15 => 'The Devil',
            ],
            $this->future->getSpiritual()->getTraits()
        );
    }

    public function testGetIntellectual()
    {
        self::assertSame('Intellectual', $this->past->getIntellectual()->getName());
        self::assertSame(1992, $this->past->getIntellectual()->getYear());
        self::assertSame(2072, $this->future->getIntellectual()->getYear());

        self::assertSame(
            [
                14 => 'Temperance',
                4 => 'The Emperor',
                16 => 'The Tower',
            ],
            $this->past->getIntellectual()->getTraits()
        );
        self::assertSame(
            [
                15 => 'The Devil',
                12 => 'The Hanged Man',
                6 => 'The Lovers',
            ],
            $this->future->getIntellectual()->getTraits()
        );
    }

    public function testGetBelief()
    {
        self::assertSame('Belief', $this->past->getBelief()->getName());
        self::assertSame(1962, $this->past->getBelief()->getYear());
        self::assertSame(2042, $this->future->getBelief()->getYear());

        self::assertSame(
            [
                6 => 'The Lovers',
                4 => 'The Emperor',
                21 => 'The World',
            ],
            $this->past->getBelief()->getTraits()
        );
        self::assertSame(
            [
                9 => 'The Hermit',
                0 => 'The Fool',
                20 => 'Judgement',
            ],
            $this->future->getBelief()->getTraits()
        );
    }

    public function testGetCareer()
    {
        self::assertSame('Career', $this->past->getCareer()->getName());
        self::assertSame(1967, $this->past->getCareer()->getYear());
        self::assertSame(2047, $this->future->getCareer()->getYear());

        self::assertSame(
            [
                7 => 'The Chariot',
                2 => 'The High Priestess',
                16 => 'The Tower',
            ],
            $this->past->getCareer()->getTraits()
        );
        self::assertSame(
            [
                3 => 'The Empress',
                6 => 'The Lovers',
                0 => 'The Fool',
            ],
            $this->future->getCareer()->getTraits()
        );
    }

    public function testGetPhysical()
    {
        self::assertSame('Physical', $this->past->getPhysical()->getName());
        self::assertSame(2042, $this->past->getPhysical()->getYear());
        self::assertSame(2122, $this->future->getPhysical()->getYear());

        self::assertSame(
            [
                13 => 'Death',
                6 => 'The Lovers',
                15 => 'The Devil',
            ],
            $this->past->getPhysical()->getTraits()
        );
        self::assertSame(
            [
                12 => 'The Hanged Man',
                6 => 'The Lovers',
                20 => 'Judgement',
            ],
            $this->future->getPhysical()->getTraits()
        );
    }

    public function testGetPartner()
    {
        self::assertSame('Partner', $this->past->getPartner()->getName());
        self::assertSame(1972, $this->past->getPartner()->getYear());
        self::assertSame(2052, $this->future->getPartner()->getYear());

        self::assertSame(
            [
                8 => 'Strength',
                12 => 'The Hanged Man',
            ],
            $this->past->getPartner()->getTraits()
        );
        self::assertSame(
            [
                12 => 'The Hanged Man',
                0 => 'The Fool',
            ],
            $this->future->getPartner()->getTraits()
        );
    }

    public function testGetAmbition()
    {
        self::assertSame('Ambition', $this->past->getAmbition()->getName());
        self::assertSame(1977, $this->past->getAmbition()->getYear());
        self::assertSame(2057, $this->future->getAmbition()->getYear());

        self::assertSame(
            [
                14 => 'Temperance',
                17 => 'The Star',
            ],
            $this->past->getAmbition()->getTraits()
        );
        self::assertSame(
            [
                9 => 'The Hermit',
                18 => 'The Moon',
            ],
            $this->future->getAmbition()->getTraits()
        );
    }

    public function testGetEmotional()
    {
        self::assertSame('Emotional', $this->past->getEmotional()->getName());
        self::assertSame(2002, $this->past->getEmotional()->getYear());
        self::assertSame(2082, $this->future->getEmotional()->getYear());

        self::assertSame(
            [
                18 => 'The Moon',
                3 => 'The Empress',
            ],
            $this->past->getEmotional()->getTraits()
        );
        self::assertSame(
            [
                5 => 'The Hierophant',
                8 => 'Strength',
            ],
            $this->future->getEmotional()->getTraits()
        );
    }

    public function testGetSocial()
    {
        self::assertSame('Social', $this->past->getSocial()->getName());
        self::assertSame(2007, $this->past->getSocial()->getYear());
        self::assertSame(2087, $this->future->getSocial()->getYear());

        self::assertSame(
            [
                21 => 'The World',
                1 => 'The Magician',
            ],
            $this->past->getSocial()->getTraits()
        );
        self::assertSame(
            [
                18 => 'The Moon',
                14 => 'Temperance',
            ],
            $this->future->getSocial()->getTraits()
        );
    }

    public function testGetTalent()
    {
        self::assertSame('Talent', $this->past->getTalent()->getName());
        self::assertSame(1982, $this->past->getTalent()->getYear());
        self::assertSame(2062, $this->future->getTalent()->getYear());

        self::assertSame(
            [
                10 => 'Wheel of Fortune',
                13 => 'Death',
                9 => 'The Hermit',
            ],
            $this->past->getTalent()->getTraits()
        );
        self::assertSame(
            [
                15 => 'The Devil',
                8 => 'Strength',
                13 => 'Death',
            ],
            $this->future->getTalent()->getTraits()
        );
    }

    public function testGetBusiness()
    {
        self::assertSame('Business', $this->past->getBusiness()->getName());
        self::assertSame(1987, $this->past->getBusiness()->getYear());
        self::assertSame(2067, $this->future->getBusiness()->getYear());

        self::assertSame(
            [
                7 => 'The Chariot',
                6 => 'The Lovers',
                0 => 'The Fool',
            ],
            $this->past->getBusiness()->getTraits()
        );
        self::assertSame(
            [
                9 => 'The Hermit',
                18 => 'The Moon',
                15 => 'The Devil',
            ],
            $this->future->getBusiness()->getTraits()
        );
    }

    public function testGetRelationship()
    {
        self::assertSame('Relationship', $this->past->getRelationship()->getName());
        self::assertSame(2012, $this->past->getRelationship()->getYear());
        self::assertSame(2092, $this->future->getRelationship()->getYear());

        self::assertSame(
            [
                14 => 'Temperance',
                1 => 'The Magician',
                21 => 'The World',
            ],
            $this->past->getRelationship()->getTraits()
        );
        self::assertSame(
            [
                10 => 'Wheel of Fortune',
                8 => 'Strength',
                18 => 'The Moon',
            ],
            $this->future->getRelationship()->getTraits()
        );
    }

    public function testGetFinancial()
    {
        self::assertSame('Financial', $this->past->getFinancial()->getName());
        self::assertSame(2017, $this->past->getFinancial()->getYear());
        self::assertSame(2097, $this->future->getFinancial()->getYear());

        /** @noinspection PhpDuplicateArrayKeysInspection */
        self::assertSame(
            [
                20 => 'Judgement',
                16 => 'The Tower',
                16 => 'The Tower',
            ],
            $this->past->getFinancial()->getTraits()
        );
        self::assertSame(
            [
                14 => 'Temperance',
                4 => 'The Emperor',
                21 => 'The World',
            ],
            $this->future->getFinancial()->getTraits()
        );
    }

    public function testGetSon()
    {
        self::assertSame('Son', $this->past->getSon()->getName());
        self::assertSame(2022, $this->past->getSon()->getYear());
        self::assertSame(2102, $this->future->getSon()->getYear());

        self::assertSame(
            [
                20 => 'Judgement',
                21 => 'The World',
                17 => 'The Star',
            ],
            $this->past->getSon()->getTraits()
        );
        self::assertSame(
            [
                15 => 'The Devil',
                18 => 'The Moon',
                2 => 'The High Priestess',
            ],
            $this->future->getSon()->getTraits()
        );
    }

    public function testGetDaughter()
    {
        self::assertSame('Daughter', $this->past->getDaughter()->getName());
        self::assertSame(2027, $this->past->getDaughter()->getYear());
        self::assertSame(2107, $this->future->getDaughter()->getYear());

        self::assertSame(
            [
                19 => 'The Sun',
                10 => 'Wheel of Fortune',
                14 => 'Temperance',
            ],
            $this->past->getDaughter()->getTraits()
        );
        /** @noinspection PhpDuplicateArrayKeysInspection */
        self::assertSame(
            [
                21 => 'The World',
                6 => 'The Lovers',
                6 => 'The Lovers',
            ],
            $this->future->getDaughter()->getTraits()
        );
    }

    public function testGetGoal()
    {
        self::assertSame('Goal', $this->past->getGoal()->getName());
        self::assertSame(0, $this->past->getGoal()->getYear());
        self::assertSame(0, $this->future->getGoal()->getYear());

        self::assertSame(
            [
                11 => 'Justice',
                10 => 'Wheel of Fortune',
                6 => 'The Lovers',
            ],
            $this->past->getGoal()->getTraits()
        );
        self::assertSame(
            [
                8 => 'Strength',
                4 => 'The Emperor',
                19 => 'The Sun',
            ],
            $this->future->getGoal()->getTraits()
        );
    }

    public function testGetCharacter()
    {
        self::assertSame('Character', $this->past->getCharacter()->getName());
        self::assertSame(2032, $this->past->getCharacter()->getYear());
        self::assertSame(2112, $this->future->getCharacter()->getYear());

        self::assertSame(
            [
                12 => 'The Hanged Man',
                0 => 'The Fool',
                2 => 'The High Priestess',
                11 => 'Justice',
            ],
            $this->past->getCharacter()->getTraits()
        );
        self::assertSame(
            [
                3 => 'The Empress',
                4 => 'The Emperor',
                20 => 'Judgement',
                6 => 'The Lovers',
            ],
            $this->future->getCharacter()->getTraits()
        );
    }

    public function testGetHealth()
    {
        self::assertSame('Health', $this->past->getHealth()->getName());
        self::assertSame(2037, $this->past->getHealth()->getYear());
        self::assertSame(2117, $this->future->getHealth()->getYear());

        /** @noinspection PhpDuplicateArrayKeysInspection */
        self::assertSame(
            [
                17 => 'The Star',
                4 => 'The Emperor',
                2 => 'The High Priestess',
                17 => 'The Star',
            ],
            $this->past->getHealth()->getTraits()
        );
        /** @noinspection PhpDuplicateArrayKeysInspection */
        self::assertSame(
            [
                13 => 'Death',
                10 => 'Wheel of Fortune',
                9 => 'The Hermit',
                13 => 'Death',
            ],
            $this->future->getHealth()->getTraits()
        );
    }
}
