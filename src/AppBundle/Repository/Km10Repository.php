<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Km10;
use Doctrine\ORM\Query;
use CrEOF\Spatial\ORM\Query\AST\Functions\PostgreSql\STIntersects;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Km10Repository
 *
 */
class Km10Repository extends \Doctrine\ORM\EntityRepository
{
    public function getMailleNativeSql($point)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping($em);
        $rsm->addScalarResult('nom_maille','maille');

        $query = $this->_em->createNativeQuery('SELECT nom_maille FROM km10 AS k WHERE ST_Intersects(ST_GeomFromText(
            \'POINT('.$point.')\'), k.polygon)', $rsm);

        $results = $query->getResult();
        dump($results);
        // TODO tester le results avant de retourner sa valeur. Verifier qu'il retourne 1 seule valeur ou false ou 0. Si
        // autre resultat throw new Exception()
        return $results[0]['maille'];
    }
}