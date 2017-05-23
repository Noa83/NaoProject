<?php
namespace AppBundle\Tests\Services;


use AppBundle\Services\DataToArrayMailleNameAndNumberOfBirds;
use AppBundle\Entity\Km10;
use AppBundle\Entity\Observation;

class DataToArrayMailleNameAndNumberOfBirdsTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED_ARRAY = [[["Alderaan", 1],["Endor", 1]],2];
    const EXPECTED_ARRAY_BEFORE_JSON_RESPONSE = [
        "cols"=>
            [
                [
                    "id"=>"",
                    "label"=>"Nom de la Maille",
                    "pattern"=>"","type"=>"string"
                ],
                [
                    "id"=>"",
                    "label"=>"Nombre d'individus",
                    "pattern"=>"",
                    "type"=>"number"
                ]
            ],
        "rows"=>
            [
                [
                    "c"=>
                        [
                            [
                                "v"=>"Alderaan",
                                "f"=>null
                            ],
                            [
                                "v"=>1,
                                "f"=>null
                            ]
                        ]
                ],
                [
                    "c"=>
                        [
                            [
                                "v"=>"Endor",
                                "f"=>null
                            ],
                            [
                                "v"=>1,
                                "f"=>null
                            ]
                        ]
                ]
            ]
    ];

    private $EntityList;
    private $service;

    protected function setUp()
    {

        $nomMaille1 = 'Alderaan';
        $nomMaille2 = 'Endor';

        $km10A = new Km10();
        $kmNameA = new \ReflectionProperty(get_class($km10A), 'nomMaille');
        $kmNameA->setAccessible(true);
        $kmNameA->setValue($km10A, $nomMaille1);
        $kmNameA->setAccessible(false);
        $km10B = new Km10();
        $kmNameB = new \ReflectionProperty(get_class($km10B), 'nomMaille');
        $kmNameB->setAccessible(true);
        $kmNameB->setValue($km10B, $nomMaille2);
        $kmNameB->setAccessible(false);
        $observationA = new Observation();
        $kmNameAobs = new \ReflectionProperty(get_class($km10A), 'observations');
        $kmNameAobs->setAccessible(true);
        $kmNameAobs->setValue($km10A, $observationA);
        $kmNameAobs->setAccessible(false);
        $observationB = new Observation();
        $kmNameBobs = new \ReflectionProperty(get_class($km10B), 'observations');
        $kmNameBobs->setAccessible(true);
        $kmNameBobs->setValue($km10B, $observationB);
        $kmNameBobs->setAccessible(false);

        $this->EntityList = [$km10A,$km10B];
        $this->service = new DataToArrayMailleNameAndNumberOfBirds();

    }

    public function testGetJson()
    {
        $result = $this->service->getJsonMailleNameAndNumberOfBirds($this->EntityList);
        $this->assertEquals($result, self::EXPECTED_ARRAY_BEFORE_JSON_RESPONSE);
    }

    public function testGetArrayFromArrayOfEntity()
    {
        $result = $this->service->GetArrayMailleNameAndNumberOfBirds($this->EntityList);
        $this->assertEquals($result, self::EXPECTED_ARRAY);
    }
}