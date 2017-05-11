<?php

namespace AppBundle\Services;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Observation;


class ObservationManager
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function create(Observation $observation)
    {

        //Persistance Bdd
        $em = $this->manager;
        $em->persist($observation);
        $em->flush();
    }
}