<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ObservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ObservationRepository extends EntityRepository
{
    public function getObservationInfoWithMailleByBird($birdId)
    {
        $list = $this->createQueryBuilder('o')
            ->where('o.bird = :birdId')
            ->setParameter('birdId', $birdId)
//            ->andWhere('o.validated = true')
            ->leftJoin('o.km10Maille', 'km')
            ->addSelect('km')
            ->getQuery()
            ->getResult();
        return $list;
    }

    public function getOneMailleGeoJsonByBird($birdId, $observationId)
    {
        $list = $this->createQueryBuilder('o')
            ->where('o.bird = :birdId')
            ->setParameter('birdId', $birdId)
            ->andWhere('o.id = :observationId')
            ->setParameter('observationId', $observationId)
//            ->andWhere('o.validated = true')
            ->leftJoin('o.km10Maille', 'km')
            ->addSelect('km')
            ->getQuery()
            ->getResult();
        return $list;
    }

    public function find10ByBird($bird){

        $results = $this->findBy(array("bird" => $bird), array('id' => 'DESC','date' => 'DESC'));
        if (empty($results)){
            throw new \Exception();
        }
        return $results;
    }
}
