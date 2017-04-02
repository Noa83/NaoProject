<?php

namespace AppBundle\Services;


use AppBundle\Model\ObservationModel;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Observation;
use AppBundle\Entity\Image;
use AppBundle\Entity\Birds;


class ObservationRecording
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function persist(ObservationModel $observationModel)
    {
        //Génération du chemin de l'image uploadée
        $file = $observationModel->getImage();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getParameter('birds_images'), $fileName);
        $fileUrl = 'web/images/birdsImages/'.$fileName.'\'';

        //Affectation du nom de la maille par rapport aux cooordonnées.
        $this->get('maille.finder')->find($observationModel->getLatLong());

        //Affectation des données du formulaire à l'entité Observation
        $observation = new Observation();
        $observation->setImageUrl($fileUrl);
        $observation->setDate($observationModel->getDate());
        $observation->setBird($observationModel->getBirds());
        $observation->setLatLong($observationModel->getLatLong());
        $observation->setNomMaille('nom');
        $observation->setMsg('blabla');
        //$observation->setIdUser('');
        $observation->setValidated('');

        $em = $this->manager;
        $em->persist($observation);
        $em->flush();
    }
}