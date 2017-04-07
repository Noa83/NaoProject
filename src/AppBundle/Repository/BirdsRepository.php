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
            ->select('b.id', 'b.nomVern', 'b.nomValide')
            ->from('AppBundle:Birds', 'b')
            ->orderBy('b.nomVern')
            ->getQuery()
            ->getResult();

        foreach ($list as $bird) {
            if(empty($bird['nomVern']))
            {
                $birdSpecie = $bird['nomValide'];
            }else{
                $birdSpecie = $bird['nomVern'] . ' (' . $bird['nomValide'] . ')';
            }
            $arrayList[$birdSpecie] = $bird['id'];

        }
        return $arrayList;
    }
}