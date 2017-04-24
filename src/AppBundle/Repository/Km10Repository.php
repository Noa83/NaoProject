<?php
namespace AppBundle\Repository;
use AppBundle\Entity\Km10;
use Doctrine\ORM\Query\ResultSetMapping;
/**
 * Km10Repository
 */
class Km10Repository extends \Doctrine\ORM\EntityRepository
{
    public function getMailleNativeSql($point)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping($em);
        $rsm->addEntityResult(Km10::class, 'k');
        $rsm->addFieldResult('k', 'id', 'id');
        $rsm->addFieldResult('k', 'nom_maille', 'nomMaille');
        $rsm->addFieldResult('k', 'polygon', 'polygon');
        $query = $this->_em->createNativeQuery('SELECT k.nom_maille, ST_AsText(k.polygon) as polygon, k.id FROM km10 AS k WHERE ST_Intersects(ST_GeomFromText(:point),
            k.polygon)', $rsm)
        ->setParameter('point', $point)
        ;
        $results = $query->getResult();
        if (empty($results)){
            throw new \Exception();
        }
        return $results[0];
    }
    public function getMaillesWithBird($birdId)
    {
        return $this->createQueryBuilder('k')
            ->addSelect('obs')
            ->leftJoin('k.observations', 'obs')
            ->where('obs.bird = :birdId')
            ->setParameter('birdId', $birdId)
            ->andWhere('obs.validated = true')
            ->getQuery()
            ->getResult();
    }
}
