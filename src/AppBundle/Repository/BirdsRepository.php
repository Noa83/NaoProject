<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * BirdsRepository
 */
class BirdsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBirdsList()
    {
        $arrayList = [];
        $list = $this->_em->createQueryBuilder('b')
            ->select('b.id', 'b.NOM_VERN', 'b.NOM_VALIDE')
            ->from('AppBundle:Birds', 'b')
            ->orderBy('b.NOM_VALIDE')
            ->getQuery()
            ->getResult();

        foreach ($list as $bird) {
            $birdSpecie = $bird['NOM_VALIDE'] . ' (' . $bird['NOM_VERN'] . ')';

            $arrayList[$birdSpecie] = $bird['id'];
        }
        return $arrayList;
    }
}