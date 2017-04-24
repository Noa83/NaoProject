<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
//              ->setParameter('birdId',$birdId);



    public function find10ByBird($bird){
        $results = $this->findBy(array("bird" => $bird), array('id' => 'DESC','date' => 'DESC'));
        if (empty($results)){
            throw new \Exception();
        }
        return $results;
    }
    }

    public function getNbBirdsByMailleForChoicedBird($birdId)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping($em);

        $rsm->addEntityResult(Km10::class, 'k');
        $rsm->addFieldResult('k', 'id', 'id');
        $rsm->addFieldResult('k', 'nom_maille', 'nomMaille');
        $rsm->addFieldResult('k', 'polygon', 'polygon');

        //Requete sans le validated true
        $query = $this->_em->createNativeQuery("SELECT k.nom_maille, ST_AsText(k.polygon) as polygon, k.id FROM observation o,
 km10 k WHERE o.bird_id = :birdId AND o.km10maille_id = k.id", $rsm)
            ->setParameter('birdId',$birdId);

        //Requete avec le validated true
//        $query = $this->_em->createNativeQuery("SELECT k.nom_maille, ST_AsText(k.polygon) as polygon FROM observation o,
// km10 k WHERE o.bird_id = :birdId AND o.km10maille_id = k.id AND o.validated = true", $rsm)
//              ->setParameter('birdId',$birdId);

        $results = $query->getResult();
        return $results;
    }

    public function getOneMailleGeoJsonByBird($birdId)
    {

    }
}
