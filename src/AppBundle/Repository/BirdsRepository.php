<?php

namespace AppBundle\Repository;



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
                $birdSpecie = $bird['nomVern'];
            }
            $arrayList[$birdSpecie] = $bird['id'];

        }
        return $arrayList;
    }

    const LIMIT = 15;

    public function findBirds($term)
    {
        $qb = $this->createQueryBuilder('b');
        $qb ->select('b.id, b.nomVern')
            ->where('b.nomVern LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->setMaxResults(self::LIMIT);

        $arrayAss= $qb->getQuery()->getArrayResult();

        // Transformer le tableau associatif en un tableau standard
        $array = array();
        foreach($arrayAss as $data)
        {
            $array[] = array("nomVern"=>$data['nomVern']);
        }
        return $array;
    }
}