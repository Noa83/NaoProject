<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Query;

/**
 * BirdsRepository
 */
class BirdsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBirdsList()
    {
        $birds = array_map('current', $this->_em->createQueryBuilder('b')
            ->select('b.NOM_VERN')
            ->from('AppBundle:Birds', 'b')
            ->getQuery()
            ->execute()
           );
        $result ='';
        foreach($birds as $bird)
        {
            $result .= $bird.",";
        }

        return $result;
    }

    public function getBirdsVernList()
    {
        $birds = $this->findAll();
        dump($birds);

        $result ='';
        foreach($birds as $bird)
        {
            $result .= $bird->getNOMVERN()." (".$bird->getLBNOM()."),";
        }

        return $result;
    }

    public function getEssaiBirdsList()
    {
        $birds = array_map('current', $this->_em->createQueryBuilder('b')
            ->select('b')
            ->from('AppBundle:Birds', 'b')
            ->getQuery()
            ->execute()
        );

        return $birds;
//        $result ='';
//        foreach($birds as $bird)
//        {
//            $result .= $bird.",";
//        }
//
//        return $result;
    }

//    public function getBirdsList()
//    {
//        return array_map('current', $this->_em->createQueryBuilder('b')
//            ->select('b.NOM_VERN')
//            ->from('AppBundle:Birds', 'b')
//            ->getQuery()
//            ->execute()
//        );
//    }
}