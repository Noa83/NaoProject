<?php

namespace AppBundle\Repository;

/**
 * Km10Repository
 *
 */
class Km10Repository extends \Doctrine\ORM\EntityRepository
{
    public function getMailleName()
    {
//        $maille = array_map('current', $this->_em->createQueryBuilder('k')
//            ->select('k.polygon_geo')
//            ->from('AppBundle:Km10', 'k')
//            ->getQuery()
//            ->execute()
//        );
        $maille = $this->_em->createNativeQuery('')

        return $maille;

    }

}