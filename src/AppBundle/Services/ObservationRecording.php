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

    public function __construct($manager, $birdsImg)
    {
        $this->manager = $manager;
        $this->birdsImg = $birdsImg;
    }

    public function persist(ObservationModel $observationModel, $roles)
    {
        //Génération du chemin de l'image uploadée et enregistrement sur le serveur
        $fileUrl = '';
        $file = $observationModel->getImage();
        if (empty($file)) {
        } else {
            $fileName = md5(uniqid()) . ' . ' . $file->guessExtension();
            $file->move($this->birdsImg, $fileName);
            $fileUrl = 'web/images/birdsImages/' . $fileName . '\'';
        }

        //Affectation des données du formulaire à l'entité Observation
        $observation = new Observation();
        $observation->setImageUrl($fileUrl);
        $observation->setDate($observationModel->getDate());
        $bird = $this->manager->getRepository('AppBundle:Birds')->getBirdById($observationModel->getBirds());
        $observation->setBird($bird);
        $observation->setLongLat($observationModel->getLongLat());
        $observation->setNomMaille($observationModel->getNomMaille());
        $observation->setMsg($observationModel->getObservationMsg());
        $observation->setIdUser($observationModel->getIdUser());

        //Gestion de la validation de l'observation selon le role du user
            if (in_array('ROLE_ADMIN', $roles)||in_array('ROLE_VALIDATEUR', $roles)) {
                $observation->setValidated(1);
            } else if (in_array('ROLE_USER', $roles)) {
                $observation->setValidated(0);
            }

        //Persistance Bdd
        $em = $this->manager;
        $em->persist($observation);
        $em->flush();
    }
}