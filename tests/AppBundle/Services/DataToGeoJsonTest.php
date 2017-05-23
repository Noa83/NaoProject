<?php

namespace AppBundle\Tests\Services;

use AppBundle\Entity\Km10;
use AppBundle\Entity\Observation;
use AppBundle\Services\DataToGeoJson;
use CrEOF\Spatial\PHP\Types\Geography\LineString;
use CrEOF\Spatial\PHP\Types\Geography\Point;
use CrEOF\Spatial\PHP\Types\Geography\Polygon;

class DataToGeoJsonTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED_JSON = '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"name":"Kashyyyk"},"geometry":{"type":"Polygon","coordinates":[[[1.1,2.2],[3.3,4.4],[5.5,6.6],[7.7,8.8],[1.1,2.2]]]}}]}';

    private $entitiesList;
    private $service;

    protected function setUp()
    {
        $rings = array(new LineString([
            new Point(1.1, 2.2),
            new Point(3.3, 4.4),
            new Point(5.5, 6.6),
            new Point(7.7, 8.8),
            new Point(1.1, 2.2)
        ]));
        $polygon = new Polygon($rings);
        $nomMaille = 'Kashyyyk';

        $km10 = new Km10();
        $kmPolygon = new \ReflectionProperty(get_class($km10), 'polygon');
        $kmPolygon->setAccessible(true);
        $kmPolygon->setValue($km10, $polygon);
        $kmPolygon->setAccessible(false);
        $kmName = new \ReflectionProperty(get_class($km10), 'nomMaille');
        $kmName->setAccessible(true);
        $kmName->setValue($km10, $nomMaille);
        $kmName->setAccessible(false);
        $observation = new Observation();
        $observationKm10 = new \ReflectionProperty(get_class($observation), 'km10Maille');
        $observationKm10->setAccessible(true);
        $observationKm10->setValue($observation, $km10);
        $observationKm10->setAccessible(false);

        $this->entitiesList = [$observation];
        $this->service = new DataToGeoJson();
    }

    public function testGetGeoJson()
    {
        $result = $this->service->getGeoJson($this->entitiesList);
        $this->assertEquals($result, self::EXPECTED_JSON);
    }

}