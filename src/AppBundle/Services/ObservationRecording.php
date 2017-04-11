<?php

namespace AppBundle\Services;


use AppBundle\Entity\User;
use AppBundle\Model\ObservationModel;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Observation;


class ObservationRecording
{
    private $manager;

    public function __construct($manager, $birdsImg)
    {
        $this->manager = $manager;
        $this->birdsImg = $birdsImg;
    }

    public function persist(ObservationModel $observationModel, User $user)
    {
        //Génération du chemin de l'image uploadée et enregistrement sur le serveur
        $fileUrl = '';
        $file = $observationModel->image;
        if (empty($file)) {
        } else {
            $fileName = md5(uniqid()) . ' . ' . $file->guessExtension();
            $file->move($this->birdsImg, $fileName);
            $fileUrl = 'web/images/birdsImages/' . $fileName . '\'';
        }

        //Affectation des données du formulaire à l'entité Observation
        $observation = new Observation();
        $observation->setImageUrl($fileUrl);
        $observation->setDate($observationModel->date);
        $bird = $this->manager->getRepository('AppBundle:Birds')->getBirdById($observationModel->bird);
        $observation->setBird($bird);
        $observation->setLongitude($observationModel->long);
        $observation->setLattitude($observationModel->lat);
        $observation->setKm10Maille($this->manager->getRepository('AppBundle:Km10')
            ->getMailleNativeSql($observationModel->getLongLat()));
        $observation->setComment($observationModel->comment);
        $observation->setUser($user);

        //Gestion de la validation de l'observation selon le role du user
            if (in_array('ROLE_ADMIN', [$user])||in_array('ROLE_VALIDATEUR', [$user])) {
                $observation->setValidated(1);
            }

        //Persistance Bdd
        $em = $this->manager;
        $em->persist($observation);
        $em->flush();
    }

    public function observationToModelObs(Observation $observation){

        $observationModel = new ObservationModel();
        $observationModel->bird = $observation->getBird()->getNomValide();
        $observationModel->comment = $observation->getComment();
        $observationModel->date = $observation->getDate();
        $observationModel->image = $observation->getImageUrl();
        $observationModel->lat = $observation->getLattitude();
        $observationModel->long = $observation->getLongitude();

        return $observationModel;
    }

    public function modifyObs(ObservationModel $observationModel, User $user, Observation $observation)
    {
        //Génération du chemin de l'image uploadée et enregistrement sur le serveur
        $fileUrl = '';
        $file = $observationModel->image;
        if (empty($file)) {
        } else {
            $fileName = md5(uniqid()) . ' . ' . $file->guessExtension();
            $file->move($this->birdsImg, $fileName);
            $fileUrl = 'web/images/birdsImages/' . $fileName . '\'';
        }

        //Affectation des données du formulaire à l'entité Observation

        $observation->setImageUrl($fileUrl);
        $observation->setDate($observationModel->date);
        $bird = $this->manager->getRepository('AppBundle:Birds')->getBirdById($observationModel->bird);
        $observation->setBird($bird);
        $observation->setLongitude($observationModel->long);
        $observation->setLattitude($observationModel->lat);
        $observation->setKm10Maille($this->manager->getRepository('AppBundle:Km10')
            ->getMailleNativeSql($observationModel->getLongLat()));
        $observation->setComment($observationModel->comment);
        $observation->setUser($user);

        //Gestion de la validation de l'observation selon le role du user
        if (in_array('ROLE_ADMIN', [$user])||in_array('ROLE_VALIDATEUR', [$user])) {
            $observation->setValidated(1);
        }

        //Persistance Bdd
        $em = $this->manager;
        $em->persist($observation);
        $em->flush();
    }
}