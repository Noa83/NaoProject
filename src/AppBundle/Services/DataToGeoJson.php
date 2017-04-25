<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;

class DataToGeoJson
{
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param array[] $multipoint
     *
     * @return array
     */
    private function toArrayMultiPoint(array $multipoint)
    {
        $strings = array();
        foreach ($multipoint as $point) {
            $geoPoint = array();
            array_push($geoPoint, $point->getX());
            array_push($geoPoint, $point->getY());
            array_push($strings, $geoPoint);
        }
        return $strings;
    }


    public function getGeoJson($km10List)
    {
        //Transfo en géoJson
        $feature = [];
        foreach ($km10List as $Km10) {
            $points = [];
            $geo = $this->toArrayMultiPoint($Km10->getPolygon()->getRings()[0]->getPoints());
            array_push($points, $geo);

            $temp = array(
                'type' => 'Feature',
                'properties' => array(
                    'name' => $Km10->getNomMaille()
                ),
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => $points
                ]
            );
            array_push($feature, $temp);
        }
        $geojson = array(
            'type' => 'FeatureCollection',
            'features' => $feature
        );
        return json_encode($geojson);
    }
}