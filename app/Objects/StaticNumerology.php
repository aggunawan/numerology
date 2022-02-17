<?php

namespace App\Objects;

use App\Objects\Numerology\Category;

class StaticNumerology
{
    private $date;
    private $month;
    private $year;
    private $sum;

    private $formulas = [
        'culture' => ['Culture', 5],
        'education' => ['Education', (5 * 2)],
        'mindset' => ['Mindset', (5 * 3)],
        'belief' => ['Belief', (5 * 4)],
        'career' => ['Career', (5 * 5)],
        'partner' => ['Partner', (5 * 6)],
        'ambition' => ['Ambition', (5 * 7)],
        'talent' => ['Talent', (5 * 8)],
        'business' => ['Business', (5 * 9)],
        'intellectual' => ['Intellectual', (5 * 10)],
        'spiritual' => ['Spiritual', (5 * 11)],
        'emotional' => ['Emotional', (5 * 12)],
        'social' => ['Social', (5 * 13)],
        'relationship' => ['Relationship', (5 * 14)],
        'financial' => ['Financial', (5 * 15)],
        'son' => ['Son', (5 * 16)],
        'daughter' => ['Daughter', (5 * 17)],
        'character' => ['Character', (5 * 18)],
        'health' => ['Health', (5 * 19)],
        'physical' => ['Physical', (5 * 20)],
    ];

    private $categories = [];

    public function __construct(int $date, int $month, int $year)
    {
        $this->date = $date;
        $this->month = $month;
        $this->year = $year;
        $this->sum = $this->date + $this->month + $this->year;

        $this->categories['dayMaster'] = new Category(
            'Day Master', $this->year < date('Y') ? $this->year : date('Y')
        );

        foreach ($this->formulas as $property => $value) {
            $this->categories[$property] = new Category($value[0], $this->getDayMaster()->getYear() + $value[1]);
        }

        $this->categories['goal'] = new Category('Goal', 0);

        $this->setDayMasterTrait();
        $this->setMindsetTrait();
        $this->setEducationTrait();
        $this->setCultureTrait();
        $this->setBeliefTrait();
        $this->setSpiritualTrait();
        $this->setCareerTrait();
        $this->setIntellectualTrait();
        $this->setPhysicalTrait();
        $this->setPartnerTrait();
        $this->setAmbitionTrait();
        $this->setTalentTrait();
        $this->setEmotionalTrait();
        $this->setBusinessTrait();
        $this->setSocialTrait();
        $this->setRelationshipTrait();
        $this->setFinancialTrait();
        $this->setSonTrait();
        $this->setDaughterTrait();
        $this->setCharacterTrait();
        $this->setHealthTrait();
        $this->setGoalTrait();
    }

    public function getDayMaster(): Category
    {
        return $this->categories['dayMaster'];
    }

    public function getMindset(): Category
    {
        return $this->categories['mindset'];
    }

    public function getEducation(): Category
    {
        return $this->categories['education'];
    }

    public function getCulture(): Category
    {
        return $this->categories['culture'];
    }

    public function getSpiritual(): Category
    {
        return $this->categories['spiritual'];
    }

    public function getIntellectual(): Category
    {
        return $this->categories['intellectual'];
    }

    public function getBelief(): Category
    {
        return $this->categories['belief'];
    }

    public function getCareer(): Category
    {
        return $this->categories['career'];
    }

    public function getPhysical(): Category
    {
        return $this->categories['physical'];
    }

    public function getPartner(): Category
    {
        return $this->categories['partner'];
    }

    public function getAmbition(): Category
    {
        return $this->categories['ambition'];
    }

    public function getEmotional(): Category
    {
        return $this->categories['emotional'];
    }

    public function getSocial(): Category
    {
        return $this->categories['social'];
    }

    public function getTalent(): Category
    {
        return $this->categories['talent'];
    }

    public function getBusiness(): Category
    {
        return $this->categories['business'];
    }

    public function getRelationship(): Category
    {
        return $this->categories['relationship'];
    }

    public function getFinancial(): Category
    {
        return $this->categories['financial'];
    }

    public function getSon(): Category
    {
        return $this->categories['son'];
    }

    public function getDaughter(): Category
    {
        return $this->categories['daughter'];
    }

    public function getGoal(): Category
    {
        return $this->categories['goal'];
    }

    public function getCharacter(): Category
    {
        return $this->categories['character'];
    }

    public function getHealth(): Category
    {
        return $this->categories['health'];
    }

    protected function setDayMasterTrait(): void
    {
        $modOfSum = $this->sum % 9;
        $this->categories['dayMaster']->addTrait($modOfSum == 0 ? 9 : $modOfSum);
        $this->categories['dayMaster']->addTrait(($this->year + $this->month) % 22);
    }

    protected function setMindsetTrait(): void
    {
        $mod = ($this->date + $this->month) % 9;
        $this->categories['mindset']->addTrait($mod == 0 ? 9 : $mod);
        $this->categories['mindset']->addTrait(($this->month + (int) substr($this->year, -2)) % 22);
    }

    protected function setEducationTrait(): void
    {
        $this->categories['education']->addTrait(($this->month + $this->year) % 9);
        $this->categories['education']->addTrait(($this->date + $this->month) % 22);
    }

    protected function setCultureTrait(): void
    {
        $modOfYear = $this->year % 9;
        $this->categories['culture']->addTrait($modOfYear == 0 ? 9 : $modOfYear);
        $this->categories['culture']->addTrait($this->sum % 22);
    }

    protected function setBeliefTrait(): void
    {
        $dayMasterTrait = $this->categories['dayMaster']->getTraitCodes();
        $mindsetTrait = $this->categories['mindset']->getTraitCodes();

        $this->categories['belief']->addTrait(($dayMasterTrait[0] + $mindsetTrait[0]) % 22);
        $this->categories['belief']->addTrait(($dayMasterTrait[1] + $mindsetTrait[1]) % 22);
        $this->categories['belief']->addTrait(($dayMasterTrait[1] + $mindsetTrait[0]) % 22);
    }

    protected function setSpiritualTrait(): void
    {
        $dayMasterTrait = $this->categories['dayMaster']->getTraitCodes();
        $mindsetTrait = $this->categories['mindset']->getTraitCodes();
        $beliefTrait = $this->categories['belief']->getTraitCodes();

        $this->categories['spiritual']->addTrait(($dayMasterTrait[0] +  $mindsetTrait[0] + $beliefTrait[0]) % 22);
        $this->categories['spiritual']->addTrait(($dayMasterTrait[1] + $mindsetTrait[1] + $beliefTrait[1]) % 22);
        $this->categories['spiritual']->addTrait(($beliefTrait[0] + $mindsetTrait[0]) % 22);
    }

    protected function setCareerTrait(): void
    {
        $educationTrait = $this->categories['education']->getTraitCodes();
        $cultureTrait = $this->categories['culture']->getTraitCodes();

        $this->categories['career']->addTrait(
            ($educationTrait[0] + $cultureTrait[0]) % 9 == 0 ? 9 : (($educationTrait[0] + $cultureTrait[0]) % 9)
        );
        $this->categories['career']->addTrait(($educationTrait[1] + $cultureTrait[1]) % 22);
        $this->categories['career']->addTrait(($educationTrait[1] + $cultureTrait[0]) % 22);
    }

    protected function setIntellectualTrait(): void
    {
        $educationTrait = $this->categories['education']->getTraitCodes();
        $cultureTrait = $this->categories['culture']->getTraitCodes();
        $careerTrait = $this->categories['career']->getTraitCodes();

        $this->categories['intellectual']->addTrait(($educationTrait[0] + $cultureTrait[0] + $careerTrait[0]) % 22);
        $this->categories['intellectual']->addTrait(($educationTrait[1] + $cultureTrait[1] + $careerTrait[1]) % 22);
        $this->categories['intellectual']->addTrait(($educationTrait[0] + $careerTrait[2]) % 22);
    }

    protected function setPhysicalTrait()
    {
        $beliefTrait = $this->categories['belief']->getTraitCodes();
        $careerTrait = $this->categories['career']->getTraitCodes();

        $this->categories['physical']->addTrait(($beliefTrait[0] + $careerTrait[0]) % 22);
        $this->categories['physical']->addTrait(($beliefTrait[1] + $careerTrait[1]) % 22);
        $this->categories['physical']->addTrait(($beliefTrait[2] + $careerTrait[2]) % 22);
    }

    protected function setPartnerTrait()
    {
        $dayMaster = $this->categories['dayMaster']->getTraitCodes();
        $belief = $this->categories['belief']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();

        $this->categories['partner']->addTrait(($dayMaster[0] + $belief[0]) % 22);
        $this->categories['partner']->addTrait(($spiritual[1] + $belief[1]) % 22);
    }

    protected function setAmbitionTrait()
    {
        $culture = $this->categories['culture']->getTraitCodes();
        $career = $this->categories['career']->getTraitCodes();

        $this->categories['ambition']->addTrait(($culture[0] + $career[0]) % 22);
        $this->categories['ambition']->addTrait(($culture[1] + $career[1]) % 22);
    }

    protected function setTalentTrait()
    {
        $mindset = $this->categories['mindset']->getTraitCodes();
        $belief = $this->categories['belief']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();

        $this->categories['talent']->addTrait(($mindset[0] + $belief[0]) % 22);
        $this->categories['talent']->addTrait(($mindset[1] + $belief[1]) % 22);
        $this->categories['talent']->addTrait(($belief[2] + $spiritual[2]) % 22);
    }

    protected function setEmotionalTrait()
    {
        $partner = $this->categories['partner']->getTraitCodes();
        $talent = $this->categories['talent']->getTraitCodes();

        $this->categories['emotional']->addTrait(($partner[0] + $talent[0]) % 22);
        $this->categories['emotional']->addTrait(($partner[1] + $talent[1]) % 22);
    }

    protected function setBusinessTrait()
    {
        $education = $this->categories['education']->getTraitCodes();
        $career = $this->categories['career']->getTraitCodes();
        $intellectual = $this->categories['intellectual']->getTraitCodes();
        $culture = $this->categories['culture']->getTraitCodes();

        $this->categories['business']->addTrait(($education[0] + $career[0]) % 22);
        $this->categories['business']->addTrait(($intellectual[1] + $career[1]) % 22);
        $this->categories['business']->addTrait(($career[0] + $culture[1]) % 22);
    }

    protected function setSocialTrait()
    {
        $business = $this->categories['business']->getTraitCodes();
        $ambition = $this->categories['ambition']->getTraitCodes();

        $this->categories['social']->addTrait(($business[0] + $ambition[0]) % 22);
        $this->categories['social']->addTrait(($business[1] + $ambition[1]) % 22);
    }

    protected function setRelationshipTrait()
    {
        $emotional = $this->categories['emotional']->getTraitCodes();
        $partner = $this->categories['partner']->getTraitCodes();
        $talent = $this->categories['talent']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();
        $social = $this->categories['social']->getTraitCodes();
        $ambition = $this->categories['ambition']->getTraitCodes();

        $this->categories['relationship']->addTrait(($emotional[0] + $partner[0] + $talent[0]) % 22);
        $this->categories['relationship']->addTrait(($spiritual[1] + $emotional[1] + $partner[1]) % 22);
        $this->categories['relationship']->addTrait(($emotional[1] + $social[1] + $ambition[1]) % 22);
    }

    protected function setFinancialTrait()
    {
        $business = $this->categories['business']->getTraitCodes();
        $ambition = $this->categories['ambition']->getTraitCodes();
        $social = $this->categories['social']->getTraitCodes();
        $education = $this->categories['education']->getTraitCodes();
        $intellectual = $this->categories['intellectual']->getTraitCodes();

        $this->categories['financial']->addTrait(($business[0] + $ambition[0] + $social[0]) % 22);
        $this->categories['financial']->addTrait(($business[1] + $social[1] + $education[1]) % 22);
        $this->categories['financial']->addTrait(($business[2] + $intellectual[2]) % 22);
    }

    protected function setSonTrait()
    {
        $physical = $this->categories['physical']->getTraitCodes();
        $career = $this->categories['career']->getTraitCodes();
        $culture = $this->categories['culture']->getTraitCodes();
        $intellectual = $this->categories['intellectual']->getTraitCodes();

        $this->categories['son']->addTrait(($physical[0] + $career[0]) % 22);
        $this->categories['son']->addTrait(($physical[1] + $culture[1]) % 22);
        $this->categories['son']->addTrait(($physical[0] + $intellectual[1]) % 22);
    }

    protected function setDaughterTrait()
    {
        $belief = $this->categories['belief']->getTraitCodes();
        $physical = $this->categories['physical']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();

        $this->categories['daughter']->addTrait(($belief[0] + $physical[0]) % 22);
        $this->categories['daughter']->addTrait(($belief[1] + $physical[1]) % 22);
        $this->categories['daughter']->addTrait(($spiritual[1] + $physical[1]) % 22);
    }

    protected function setCharacterTrait()
    {
        $relationship = $this->categories['relationship']->getTraitCodes();
        $son = $this->categories['son']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();
        $mindset = $this->categories['mindset']->getTraitCodes();

        $this->categories['character']->addTrait(($relationship[0] + $son[0]) % 22);
        $this->categories['character']->addTrait(($relationship[1] + $son[1]) % 22);
        $character = ($son[2] + $relationship[2] + $spiritual[1]) % 22;
        $this->categories['character']->addTrait($character);
        $this->categories['character']->addTrait(($character + $mindset[1]) % 22);
    }

    protected function setHealthTrait()
    {
        $daughter = $this->categories['daughter']->getTraitCodes();
        $financial = $this->categories['financial']->getTraitCodes();
        $social = $this->categories['social']->getTraitCodes();
        $culture = $this->categories['culture']->getTraitCodes();

        $this->categories['health']->addTrait(($daughter[0] + $financial[0]) % 22);
        $this->categories['health']->addTrait(($daughter[1] + $financial[1]) % 22);
        $this->categories['health']->addTrait(($daughter[2] + $financial[2] + $social[1] + $culture[1]) % 22);
        $this->categories['health']->addTrait(($financial[2] + $social[1]) % 22);
    }

    protected function setGoalTrait()
    {
        $character = $this->categories['character']->getTraitCodes();
        $health = $this->categories['health']->getTraitCodes();

        $this->categories['goal']->addTrait(($character[0] + $character[1] + $health[0] + $health[1]) % 22);
        $this->categories['goal']->addTrait(($character[2] + $character[3] + $health[2] + $health[3]) % 22);
        $this->categories['goal']->addTrait(($character[3] + $health[3]) % 22);
    }
}
