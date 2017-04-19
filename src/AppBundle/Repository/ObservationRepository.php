<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Km10;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ObservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ObservationRepository extends \Doctrine\ORM\EntityRepository
{
    public function getObservationsInfosWithBirdInfo($birdId)
    {
        $list = $this->_em->createQueryBuilder('o')
            ->select('o')
            ->from('AppBundle:Observation', 'o')
            ->where('o.bird = :birdId')
            ->setParameter('birdId', $birdId)
//            ->andWhere('o.validated = true')
            ->leftJoin('o.bird', 'bird')
            ->addSelect('bird')
            ->getQuery()
            ->getResult();
        dump($list);
    }

    public function getMailleGeoJsonByBird($birdId)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping($em);

        $rsm->addScalarResult('nom_maille', 'nomMaille');
        $rsm->addScalarResult('geojson', 'polygon');

        //Requete sans le validated true
        $query = $this->_em->createNativeQuery("SELECT k.nom_maille, st_asgeojson(k.polygon) as geojson FROM observation o,
 km10 k WHERE o.bird_id = '".$birdId."' AND o.km10maille_id = k.id", $rsm);

        //Requete avec le validated true
//        $query = $this->_em->createNativeQuery("SELECT k.nom_maille, st_asgeojson(k.polygon) as geojson FROM observation o,
// km10 k WHERE o.bird_id = '".$birdId."' AND o.km10maille_id = k.id AND o.validated = true", $rsm);



        $results = $query->getResult();
        dump($results);

        //Transfo en géoJson
        $feature = [];
        foreach ($results as $row) {
            $temp = array(
                'type' => 'Feature',
                'properties' => array(
                    'name' => $row['nomMaille']
                ),
                'geometry' => json_decode($row['geometry'])
            );
            array_push($feature, $temp);
        }
        $geojson = array(
            'type' => 'FeatureCollection',
            'features' => $feature
        );
            return new JsonResponse($geojson);
    }
}
