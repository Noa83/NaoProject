<?php

namespace AppBundle\Tests\Services;


use AppBundle\Services\DataToArrayOfObjectsForAutocompleteConsultation;

class DataToArrayOfObjectsForAutocompleteConsultationTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED_BIRDSLIST = [
        [
            "label" => "Luke",
            "id" => 1
        ],
        [
            "label" => "Leia",
            "id" => 2
        ],
        [
            "label" => "Han_Solo",
            "id" => 3
        ]];

    private $birdsArray;
    private $service;

    protected function setUp()
    {
        $this->birdsArray = ["Luke" => 1, "Leia" => 2, "Han_Solo" => 3];
        $this->service = new DataToArrayOfObjectsForAutocompleteConsultation();
    }

    public function testGetArrayFromArrayEntityBirdsList()
    {
        $result = $this->service->getBirdsListForAutoComplete($this->birdsArray);
        $this->assertEquals($result, self::EXPECTED_BIRDSLIST);
    }

}