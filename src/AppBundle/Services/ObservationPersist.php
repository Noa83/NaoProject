<?php

namespace AppBundle\Services;


use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Observation;
use AppBundle\Entity\Image;
use AppBundle\Entity\Birds;

class ObservationPersist
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function observationPersist($request)
    {
        $bird = $manager->getRepository('AppBundle:Birds')->find($id);

        $observation = new Observation();
        $observation->setDate($request->getDate());
        $observation->setSpecie($bird->getSpecie());
        $observation->setLatLong('latlong');
        $observation->setNomMaille('nom');
        $observation->setMsg('blabla');
//        $observation->setIdUser();
        $observation->setValidated('');

        $image = new Image();
        $image->setUrl('');
        $image->setAlt('');

        $observation->setImage($image);
        $observation->setBird($bird);

        $em = $this->manager;
        $em->persist($observation);
        $em->flush();
    }
}