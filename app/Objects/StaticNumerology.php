<?php

namespace App\Objects;

use App\Objects\Numerology\Category;

class StaticNumerology
{
    private $date;
    private $month;
    private $year;
    private $currentYear;
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
        'emotional' => ['Enjoyment', (5 * 12)],
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

    public function __construct(int $date, int $month, int $year, int $currentYear = null)
    {
        $this->date = $date;
        $this->month = $month;
        $this->year = $year;
        $this->currentYear = $currentYear ?? 0;
        $this->sum = $this->date + $this->month + $this->year;

        $this->categories['dayMaster'] = new Category(
            'Day Master', $this->year < date('Y') ? $this->year : date('Y')
        );
        $this->categories['dayMaster_pristine'] = clone $this->categories['dayMaster'];

        foreach ($this->formulas as $property => $value) {
            $this->categories[$property] = new Category($value[0], $this->getDayMaster()->getYear() + $value[1]);
            $this->categories[sprintf("%s_pristine", $property)] = clone $this->categories[$property];
        }

        $this->categories['goal'] = new Category('Goal', 0);
        $this->categories['goal_pristine'] = clone $this->categories['goal'];

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
        $this->categories['dayMaster']->addTrait(
            (($this->date + $this->month + $this->year + $this->currentYear) % 9) == 0 ?
                9 : ($this->date + $this->month + $this->year + $this->currentYear) % 9
        );
        $this->categories['dayMaster']->addTrait(($this->year + $this->month + $this->currentYear) % 22);

        $this->categories['dayMaster_pristine']->addTrait(
            ($this->date + $this->month + $this->year) % 9 == 0 ?
                9 : ($this->date + $this->month + $this->year) % 9
        );
        $this->categories['dayMaster_pristine']->addTrait(($this->year + $this->month) % 22);
    }

    protected function setMindsetTrait(): void
    {
        $mod = ($this->date + $this->month) % 9;
        $this->categories['mindset']->addTrait($mod == 0 ? 9 : $mod);
        $this->categories['mindset']->addTrait(
            ($this->month + (int) substr($this->year + $this->currentYear, -2)) % 22
        );
        $this->categories['mindset_pristine']->addTrait($mod == 0 ? 9 : $mod);
        $this->categories['mindset_pristine']->addTrait(
            ($this->month + (int) substr($this->year, -2)) % 22
        );
    }

    protected function setEducationTrait(): void
    {
        $this->categories['education']->addTrait(($this->month + $this->year + $this->currentYear) % 9);
        $this->categories['education']->addTrait(($this->date + $this->month) % 22);
        $this->categories['education_pristine']->addTrait(($this->month + $this->year) % 9);
        $this->categories['education_pristine']->addTrait(($this->date + $this->month) % 22);
    }

    protected function setCultureTrait(): void
    {
        $this->categories['culture']->addTrait(
            ($this->year + $this->currentYear) % 9 == 0 ? 9 : ($this->year + $this->currentYear) % 9
        );
        $this->categories['culture']->addTrait(($this->sum + $this->currentYear) % 22);

        $this->categories['culture_pristine']->addTrait($this->year % 9 == 0 ? 9 : $this->year % 9);
        $this->categories['culture_pristine']->addTrait($this->sum % 22);
    }

    protected function setBeliefTrait(): void
    {
        $dayMaster = $this->categories['dayMaster']->getTraitCodes();
        $dayMasterPristine = $this->categories['dayMaster_pristine']->getTraitCodes();
        $mindset = $this->categories['mindset']->getTraitCodes();
        $mindsetPristine = $this->categories['mindset_pristine']->getTraitCodes();

        $this->categories['belief']->addTrait(($dayMaster[0] + $mindset[($this->currentYear == 0 ? 0 : 1)]) % 22);
        $this->categories['belief']->addTrait(($dayMaster[1] + $mindset[1]) % 22);
        $this->categories['belief']->addTrait(($dayMaster[1] + $mindset[0]) % 22);

        $this->categories['belief_pristine']->addTrait(($dayMasterPristine[0] + $mindsetPristine[0]) % 22);
        $this->categories['belief_pristine']->addTrait(($dayMasterPristine[1] + $mindsetPristine[1]) % 22);
        $this->categories['belief_pristine']->addTrait(($dayMasterPristine[1] + $mindsetPristine[0]) % 22);
    }

    protected function setSpiritualTrait(): void
    {
        $dayMaster = $this->categories['dayMaster']->getTraitCodes();
        $dayMasterPristine = $this->categories['dayMaster_pristine']->getTraitCodes();
        $mindset = $this->categories['mindset']->getTraitCodes();
        $mindsetPristine = $this->categories['mindset_pristine']->getTraitCodes();
        $belief = $this->categories['belief']->getTraitCodes();
        $beliefPristine = $this->categories['belief_pristine']->getTraitCodes();

        $this->categories['spiritual']->addTrait(($dayMaster[0] +  $mindset[0] + $belief[0]) % 22);
        $this->categories['spiritual']->addTrait(($dayMaster[1] + $mindset[1] + $belief[1]) % 22);

        $spiritualThree = $this->categories['spiritual']->getTraitCodes()[0] + $belief[1] + $belief[2];
        if ($this->currentYear != 0) $spiritualThree = $belief[0] + $mindset[0];

        $this->categories['spiritual']->addTrait(($spiritualThree) % 22);

        $this->categories['spiritual_pristine']->addTrait(
            ($dayMasterPristine[0] +  $mindsetPristine[0] + $beliefPristine[0]) % 22
        );
        $this->categories['spiritual_pristine']->addTrait(
            ($dayMasterPristine[1] + $mindsetPristine[1] + $beliefPristine[1]) % 22
        );
        $this->categories['spiritual_pristine']->addTrait(
            ($this->categories['spiritual_pristine']->getTraitCodes()[0] + $beliefPristine[1] + $beliefPristine[2]) % 22
        );
    }

    protected function setCareerTrait(): void
    {
        $education = $this->categories['education']->getTraitCodes();
        $educationPristine = $this->categories['education_pristine']->getTraitCodes();
        $culture = $this->categories['culture']->getTraitCodes();
        $culturePristine = $this->categories['culture_pristine']->getTraitCodes();

        $this->categories['career']->addTrait(
            ($education[0] + $culture[0]) % 9 == 0 ? 9 : (($education[0] + $culture[0]) % 9)
        );
        $this->categories['career']->addTrait(($education[1] + $culture[1]) % 22);
        $this->categories['career']->addTrait(($education[1] + $culture[0]) % 22);

        $this->categories['career_pristine']->addTrait(
            ($educationPristine[0] + $culturePristine[0]) % 9 == 0 ?
                9 : (($educationPristine[0] + $culturePristine[0]) % 9)
        );
        $this->categories['career_pristine']->addTrait(($educationPristine[1] + $culturePristine[1]) % 22);
        $this->categories['career_pristine']->addTrait(($educationPristine[1] + $culturePristine[0]) % 22);
    }

    protected function setIntellectualTrait(): void
    {
        $education = $this->categories['education']->getTraitCodes();
        $educationPristine = $this->categories['education_pristine']->getTraitCodes();
        $culture = $this->categories['culture']->getTraitCodes();
        $culturePristine = $this->categories['culture_pristine']->getTraitCodes();
        $career = $this->categories['career']->getTraitCodes();
        $careerPristine = $this->categories['career_pristine']->getTraitCodes();

        $this->categories['intellectual']->addTrait(($education[0] + $culture[0] + $career[0]) % 22);
        $this->categories['intellectual']->addTrait(($education[1] + $culture[1] + $career[1]) % 22);
        $this->categories['intellectual']->addTrait(($education[0] + $career[2]) % 22);

        $this->categories['intellectual_pristine']->addTrait(
            ($educationPristine[0] + $culturePristine[0] + $careerPristine[0]) % 22
        );
        $this->categories['intellectual_pristine']->addTrait(
            ($educationPristine[1] + $culturePristine[1] + $careerPristine[1]) % 22
        );
        $this->categories['intellectual_pristine']->addTrait(($educationPristine[0] + $careerPristine[2]) % 22);
    }

    protected function setPhysicalTrait()
    {
        $belief = $this->categories['belief']->getTraitCodes();
        $beliefPristine = $this->categories['belief_pristine']->getTraitCodes();
        $career = $this->categories['career']->getTraitCodes();
        $careerPristine = $this->categories['career_pristine']->getTraitCodes();

        $this->categories['physical']->addTrait(($belief[0] + $career[0]) % 22);
        $this->categories['physical']->addTrait(($belief[1] + $career[1]) % 22);
        $this->categories['physical']->addTrait(($belief[2] + $career[2]) % 22);

        $this->categories['physical_pristine']->addTrait(($beliefPristine[0] + $careerPristine[0]) % 22);
        $this->categories['physical_pristine']->addTrait(($beliefPristine[1] + $careerPristine[1]) % 22);
        $this->categories['physical_pristine']->addTrait(($beliefPristine[2] + $careerPristine[2]) % 22);
    }

    protected function setPartnerTrait()
    {
        $dayMaster = $this->categories['dayMaster']->getTraitCodes();
        $belief = $this->categories['belief']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();
        $dayMasterPristine = $this->categories['dayMaster_pristine']->getTraitCodes();
        $beliefPristine = $this->categories['belief_pristine']->getTraitCodes();
        $spiritualPristine = $this->categories['spiritual_pristine']->getTraitCodes();

        $this->categories['partner']->addTrait(($dayMaster[0] + $belief[0]) % 22);
        $this->categories['partner']->addTrait(($spiritual[1] + $belief[1]) % 22);
        $this->categories['partner_pristine']->addTrait(($dayMasterPristine[0] + $beliefPristine[0]) % 22);
        $this->categories['partner_pristine']->addTrait(($spiritualPristine[1] + $beliefPristine[1]) % 22);
    }

    protected function setAmbitionTrait()
    {
        $culture = $this->categories['culture_pristine']->getTraitCodes();
        $career = $this->categories['career_pristine']->getTraitCodes();

        $this->categories['ambition']->addTrait(($culture[0] + $career[0]) % 22);
        $this->categories['ambition']->addTrait(($culture[1] + $career[1]) % 22);
        $this->categories['ambition_pristine']->addTrait(($culture[0] + $career[0]) % 22);
        $this->categories['ambition_pristine']->addTrait(($culture[1] + $career[1]) % 22);
    }

    protected function setTalentTrait()
    {
        $mindset = $this->categories['mindset']->getTraitCodes();
        $belief = $this->categories['belief']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();
        $mindsetPristine = $this->categories['mindset_pristine']->getTraitCodes();
        $beliefPristine = $this->categories['belief_pristine']->getTraitCodes();
        $spiritualPristine = $this->categories['spiritual_pristine']->getTraitCodes();

        $this->categories['talent']->addTrait(($mindset[0] + $belief[0]) % 22);
        $this->categories['talent']->addTrait(($mindset[1] + $belief[1]) % 22);
        $this->categories['talent']->addTrait(($belief[2] + $spiritual[2]) % 22);

        $this->categories['talent_pristine']->addTrait(($mindsetPristine[0] + $beliefPristine[0]) % 22);
        $this->categories['talent_pristine']->addTrait(($mindsetPristine[1] + $beliefPristine[1]) % 22);
        $this->categories['talent_pristine']->addTrait(($beliefPristine[2] + $spiritualPristine[2]) % 22);
    }

    protected function setEmotionalTrait()
    {
        $partner = $this->categories['partner']->getTraitCodes();
        $talent = $this->categories['talent']->getTraitCodes();
        $partnerPristine = $this->categories['partner_pristine']->getTraitCodes();
        $talentPristine = $this->categories['talent_pristine']->getTraitCodes();

        $this->categories['emotional']->addTrait(($partner[0] + $talent[0]) % 22);
        $this->categories['emotional']->addTrait(($partner[1] + $talent[1]) % 22);

        $this->categories['emotional_pristine']->addTrait(($partnerPristine[0] + $talentPristine[0]) % 22);
        $this->categories['emotional_pristine']->addTrait(($partnerPristine[1] + $talentPristine[1]) % 22);
    }

    protected function setBusinessTrait()
    {
        $education = $this->categories['education']->getTraitCodes();
        $career = $this->categories['career']->getTraitCodes();
        $intellectual = $this->categories['intellectual']->getTraitCodes();
        $culture = $this->categories['culture']->getTraitCodes();

        $educationPristine = $this->categories['education_pristine']->getTraitCodes();
        $careerPristine = $this->categories['career_pristine']->getTraitCodes();
        $intellectualPristine = $this->categories['intellectual_pristine']->getTraitCodes();
        $culturePristine = $this->categories['culture_pristine']->getTraitCodes();

        $this->categories['business']->addTrait(($education[0] + $career[0]) % 22);
        $this->categories['business']->addTrait(($intellectual[1] + $career[1]) % 22);
        $this->categories['business']->addTrait(($career[0] + $culture[1]) % 22);

        $this->categories['business_pristine']->addTrait(($educationPristine[0] + $careerPristine[0]) % 22);
        $this->categories['business_pristine']->addTrait(($intellectualPristine[1] + $careerPristine[1]) % 22);
        $this->categories['business_pristine']->addTrait(($careerPristine[0] + $culturePristine[1]) % 22);
    }

    protected function setSocialTrait()
    {
        $business = $this->categories['business']->getTraitCodes();
        $ambition = $this->categories['ambition']->getTraitCodes();
        $businessPristine = $this->categories['business_pristine']->getTraitCodes();
        $ambitionPristine = $this->categories['ambition_pristine']->getTraitCodes();

        $this->categories['social']->addTrait(($business[0] + $ambition[0]) % 22);
        $this->categories['social']->addTrait(($business[1] + $ambition[1]) % 22);
        $this->categories['social_pristine']->addTrait(($businessPristine[0] + $ambitionPristine[0]) % 22);
        $this->categories['social_pristine']->addTrait(($businessPristine[1] + $ambitionPristine[1]) % 22);
    }

    protected function setRelationshipTrait()
    {
        $emotional = $this->categories['emotional']->getTraitCodes();
        $partner = $this->categories['partner']->getTraitCodes();
        $talent = $this->categories['talent']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();
        $social = $this->categories['social']->getTraitCodes();
        $ambition = $this->categories['ambition']->getTraitCodes();

        $emotionalPristine = $this->categories['emotional_pristine']->getTraitCodes();
        $partnerPristine = $this->categories['partner_pristine']->getTraitCodes();
        $talentPristine = $this->categories['talent_pristine']->getTraitCodes();
        $spiritualPristine = $this->categories['spiritual_pristine']->getTraitCodes();
        $socialPristine = $this->categories['social_pristine']->getTraitCodes();
        $ambitionPristine = $this->categories['ambition_pristine']->getTraitCodes();

        $this->categories['relationship']->addTrait(($emotional[0] + $partner[0] + $talent[0]) % 22);
        $this->categories['relationship']->addTrait(($spiritual[1] + $emotional[1] + $partner[1]) % 22);
        $this->categories['relationship']->addTrait(($emotional[1] + $social[1] + $ambition[1]) % 22);

        $this->categories['relationship_pristine']->addTrait(
            ($emotionalPristine[0] + $partnerPristine[0] + $talentPristine[0]) % 22
        );
        $this->categories['relationship_pristine']->addTrait(
            ($spiritualPristine[1] + $emotionalPristine[1] + $partnerPristine[1]) % 22
        );
        $this->categories['relationship_pristine']->addTrait(
            ($emotionalPristine[1] + $socialPristine[1] + $ambitionPristine[1]) % 22
        );
    }

    protected function setFinancialTrait()
    {
        $business = $this->categories['business']->getTraitCodes();
        $ambition = $this->categories['ambition']->getTraitCodes();
        $social = $this->categories['social']->getTraitCodes();
        $education = $this->categories['education']->getTraitCodes();
        $intellectual = $this->categories['intellectual']->getTraitCodes();
        $businessPristine = $this->categories['business_pristine']->getTraitCodes();
        $ambitionPristine = $this->categories['ambition_pristine']->getTraitCodes();
        $socialPristine = $this->categories['social_pristine']->getTraitCodes();
        $educationPristine = $this->categories['education_pristine']->getTraitCodes();
        $intellectualPristine = $this->categories['intellectual_pristine']->getTraitCodes();

        $this->categories['financial']->addTrait(($business[0] + $ambition[0] + $social[0]) % 22);
        $this->categories['financial']->addTrait(
            ($business[$this->currentYear == 0 ? 1 : 0] + $social[1] + $education[1]) % 22
        );
        $this->categories['financial']->addTrait(($business[2] + $intellectual[2]) % 22);
        $this->categories['financial_pristine']->addTrait(
            ($businessPristine[0] + $ambitionPristine[0] + $socialPristine[0]) % 22
        );
        $this->categories['financial_pristine']->addTrait(
            ($businessPristine[1] + $socialPristine[1] + $educationPristine[1]) % 22
        );
        $this->categories['financial_pristine']->addTrait(($businessPristine[2] + $intellectualPristine[2]) % 22);
    }

    protected function setSonTrait()
    {
        $physical = $this->categories['physical']->getTraitCodes();
        $physicalPristine = $this->categories['physical_pristine']->getTraitCodes();
        $career = $this->categories['career']->getTraitCodes();
        $careerPristine = $this->categories['career_pristine']->getTraitCodes();
        $culture = $this->categories['culture']->getTraitCodes();
        $culturePristine = $this->categories['culture_pristine']->getTraitCodes();
        $intellectual = $this->categories['intellectual']->getTraitCodes();
        $intellectualPristine = $this->categories['intellectual_pristine']->getTraitCodes();

        $this->categories['son']->addTrait(($physical[0] + $career[0]) % 22);
        $this->categories['son']->addTrait(($physical[1] + $culture[1]) % 22);
        $this->categories['son']->addTrait(($physical[0] + $intellectual[1]) % 22);
        $this->categories['son_pristine']->addTrait(($physicalPristine[0] + $careerPristine[0]) % 22);
        $this->categories['son_pristine']->addTrait(($physicalPristine[1] + $culturePristine[1]) % 22);
        $this->categories['son_pristine']->addTrait(($physicalPristine[0] + $intellectualPristine[1]) % 22);
    }

    protected function setDaughterTrait()
    {
        $belief = $this->categories['belief']->getTraitCodes();
        $physical = $this->categories['physical']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();
        $beliefPristine = $this->categories['belief_pristine']->getTraitCodes();
        $physicalPristine = $this->categories['physical_pristine']->getTraitCodes();
        $spiritualPristine = $this->categories['spiritual_pristine']->getTraitCodes();

        $this->categories['daughter']->addTrait(($belief[0] + $physical[0]) % 22);
        $this->categories['daughter']->addTrait(($belief[1] + $physical[1]) % 22);
        $this->categories['daughter']->addTrait(($spiritual[1] + $physical[1]) % 22);
        $this->categories['daughter_pristine']->addTrait(($beliefPristine[0] + $physicalPristine[0]) % 22);
        $this->categories['daughter_pristine']->addTrait(($beliefPristine[1] + $physicalPristine[1]) % 22);
        $this->categories['daughter_pristine']->addTrait(($spiritualPristine[1] + $physicalPristine[1]) % 22);
    }

    protected function setCharacterTrait()
    {
        $relationship = $this->categories['relationship']->getTraitCodes();
        $son = $this->categories['son']->getTraitCodes();
        $spiritual = $this->categories['spiritual']->getTraitCodes();
        $mindset = $this->categories['mindset']->getTraitCodes();
        $relationshipPristine = $this->categories['relationship_pristine']->getTraitCodes();
        $sonPristine = $this->categories['son_pristine']->getTraitCodes();
        $spiritualPristine = $this->categories['spiritual_pristine']->getTraitCodes();
        $mindsetPristine = $this->categories['mindset_pristine']->getTraitCodes();

        $this->categories['character']->addTrait(($relationship[0] + $son[0]) % 22);
        $this->categories['character']->addTrait(($relationship[1] + $son[1]) % 22);
        $character = ($son[2] + $relationship[2] + $spiritual[1]) % 22;
        $this->categories['character']->addTrait($character);
        $this->categories['character']->addTrait(($character + $mindset[1]) % 22);

        $this->categories['character_pristine']->addTrait(($relationshipPristine[0] + $sonPristine[0]) % 22);
        $this->categories['character_pristine']->addTrait(($relationshipPristine[1] + $sonPristine[1]) % 22);
        $character = ($sonPristine[2] + $relationshipPristine[2] + $spiritualPristine[1]) % 22;
        $this->categories['character_pristine']->addTrait($character);
        $this->categories['character_pristine']->addTrait(($character + $mindsetPristine[1]) % 22);
    }

    protected function setHealthTrait()
    {
        $daughter = $this->categories['daughter']->getTraitCodes();
        $financial = $this->categories['financial']->getTraitCodes();
        $social = $this->categories['social']->getTraitCodes();
        $culture = $this->categories['culture']->getTraitCodes();
        $daughterPristine = $this->categories['daughter_pristine']->getTraitCodes();
        $financialPristine = $this->categories['financial_pristine']->getTraitCodes();
        $socialPristine = $this->categories['social_pristine']->getTraitCodes();
        $culturePristine = $this->categories['culture_pristine']->getTraitCodes();

        $this->categories['health']->addTrait(($daughter[0] + $financial[0]) % 22);
        $this->categories['health']->addTrait(($daughter[1] + $financial[1]) % 22);
        $this->categories['health']->addTrait(($daughter[2] + $financial[2] + $social[1] + $culture[1]) % 22);
        $this->categories['health']->addTrait(($financial[2] + $social[1]) % 22);

        $this->categories['health_pristine']->addTrait(($daughterPristine[0] + $financialPristine[0]) % 22);
        $this->categories['health_pristine']->addTrait(($daughterPristine[1] + $financialPristine[1]) % 22);
        $this->categories['health_pristine']->addTrait(
            ($daughterPristine[2] + $financialPristine[2] + $socialPristine[1] + $culturePristine[1]) % 22
        );
        $this->categories['health_pristine']->addTrait(($financialPristine[2] + $socialPristine[1]) % 22);
    }

    protected function setGoalTrait()
    {
        $character = $this->categories['character']->getTraitCodes();
        $health = $this->categories['health']->getTraitCodes();
        $characterPristine = $this->categories['character_pristine']->getTraitCodes();
        $healthPristine = $this->categories['health_pristine']->getTraitCodes();

        $this->categories['goal']->addTrait(($character[0] + $character[1] + $health[0] + $health[1]) % 22);
        $this->categories['goal']->addTrait(($character[2] + $character[3] + $health[2] + $health[3]) % 22);
        $this->categories['goal']->addTrait(($characterPristine[3] + $healthPristine[3]) % 22);

        $this->categories['goal_pristine']->addTrait(
            ($characterPristine[0] + $characterPristine[1] + $healthPristine[0] + $healthPristine[1]) % 22
        );
        $this->categories['goal_pristine']->addTrait(
            ($characterPristine[2] + $characterPristine[3] + $healthPristine[2] + $healthPristine[3]) % 22
        );
        $this->categories['goal_pristine']->addTrait(($characterPristine[3] + $healthPristine[3]) % 22);
    }
}
