<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Km10;
//use Doctrine\ORM\Query;
//use CrEOF\Spatial\ORM\Query\AST\Functions\PostgreSql\STIntersects;
//use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\Query\ResultSetMapping;


/**
 * Km10Repository
 *
 * @Throws Exception
 *
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

        $query = $this->_em->createNativeQuery('SELECT * FROM km10 AS k WHERE ST_Intersects(ST_GeomFromText(
            \'POINT(' . $point . ')\'), k.polygon)', $rsm);

        $results = $query->getResult();

        if (empty($results))
        {
            throw new \Exception("Les coordonnées saisies ne se situent pas sur le territoire métropolitain Français.");

        } else {
            return $results[0];
        }

    }


}