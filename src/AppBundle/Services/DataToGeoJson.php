<?php
namespace AppBundle\Services;
class DataToGeoJson
{
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
    public function getGeoJson($observationList)
    {
        //Transfo en géoJson
        $feature = [];
        foreach ($observationList as $Observation) {
            $points = [];
            $geo = $this->toArrayMultiPoint($Observation->getKm10Maille()->getPolygon()->getRings()[0]->getPoints());
            array_push($points, $geo);
            $temp = array(
                'type' => 'Feature',
                'properties' => array(
                    'name' => $Observation->getKm10Maille()->getNomMaille()
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