<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * BirdsRepository
 */
class BirdsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBirdById($id)
    {
        return $this->find($id);
    }

    public function getBirdsList()
    {
        $arrayList = [];
        $list = $this->_em->createQueryBuilder('b')
            ->select('b.id', 'b.NOM_VERN', 'b.NOM_VALIDE')
            ->from('AppBundle:Birds', 'b')
            ->orderBy('b.NOM_VERN')
            ->getQuery()
            ->getResult();

        foreach ($list as $bird) {
            if(empty($bird['NOM_VERN']))
            {
                $birdSpecie = $bird['NOM_VALIDE'];
            }else{
                $birdSpecie = $bird['NOM_VERN'] . ' (' . $bird['NOM_VALIDE'] . ')';
            }
            $arrayList[$birdSpecie] = $bird['id'];

        }
        return $arrayList;
    }
}