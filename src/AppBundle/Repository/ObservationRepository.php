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
            ->addSelect('km')
            ->leftJoin('o.km10Maille', 'km')
            ->where('o.bird = :birdId')
            ->setParameter('birdId', $birdId)
            ->andWhere('o.validated = true')
            ->getQuery()
            ->getResult();
        return $list;
    }
    public function getOneMailleGeoJsonByBird($birdId, $observationId)
    {
        $list = $this->createQueryBuilder('o')
            ->addSelect('km')
            ->leftJoin('o.km10Maille', 'km')
            ->where('o.bird = :birdId')
            ->setParameter('birdId', $birdId)
            ->andWhere('o.id = :observationId')
            ->setParameter('observationId', $observationId)
            ->getQuery()
            ->getResult();
        return $list;
    }
    public function find10ByBird($birdId){
        $results = $this->createQueryBuilder('o')
            ->where('o.bird = :birdId')
            ->setParameter('birdId', $birdId)
            ->andWhere('o.validated = true')
            ->orderBy('o.date', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
        if (empty($results)){
            throw new \Exception();
        }
        return $results;
    }
}
