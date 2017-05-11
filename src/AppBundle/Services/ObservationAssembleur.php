<?php

namespace AppBundle\Services;


use AppBundle\Entity\User;
use AppBundle\Model\ObservationModel;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Observation;


class ObservationAssembleur
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function createFromModel(ObservationModel $observationModel, User $user, $imageUrl)
    {

        //Affectation des données du formulaire à l'entité Observation
        $observation = new Observation();
        $this->editObservation($observationModel, $observation, $user, $imageUrl);

        return $observation;
    }

    public function editObservation(ObservationModel $observationModel, Observation $observation, User $user, $imageUrl){

        $observation->setImageUrl($imageUrl);
        $observation->setDate($observationModel->date);
        $bird = $this->manager->getRepository('AppBundle:Birds')->getBirdById($observationModel->birdId);
        $observation->setBird($bird);
        $observation->setLongitude($observationModel->long);
        $observation->setLattitude($observationModel->lat);
        $observation->setKm10Maille($this->manager->getRepository('AppBundle:Km10')
            ->getMailleNativeSql($observationModel->getLongLat()));
        $observation->setComment($observationModel->comment);
        $observation->setUser($user);
        $observation->setValidated(false);

        //Gestion de la validation de l'observation selon le role du user
        if ($user->getRoles() == array("ROLE_ADMIN") || $user->getRoles() == array("ROLE_VALIDATEUR")){
            $observation->setValidated(true);
        }

        return $observation;
    }

    public function createFromObservation(Observation $observation){

        $observationModel = new ObservationModel();

        if (empty($observation->getBird()->getNomVern())){
            $observationModel->birdName = $observation->getBird()->getNomValide();
        }else{
            $observationModel->birdName = $observation->getBird()->getNomVern();
        }
        $observationModel->birdId = $observation->getBird()->getId();
        $observationModel->comment = $observation->getComment();
        $observationModel->date = $observation->getDate();
        $observationModel->image = $observation->getImageUrl();
        $observationModel->lat = $observation->getLattitude();
        $observationModel->long = $observation->getLongitude();

        return $observationModel;
    }
}