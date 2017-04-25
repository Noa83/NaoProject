<?php

namespace AppBundle\Services;


use AppBundle\Entity\User;
use AppBundle\Model\ObservationModel;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Observation;


class ImageManager
{

    public function __construct($birdsImg)
    {
        $this->birdsImg = $birdsImg;
    }

    public function createObservationImage(ObservationModel $observationModel)
    {
        //Génération du chemin de l'image uploadée et enregistrement sur le serveur
        $fileUrl = '';
        $file = $observationModel->image;
        if (empty($file)) {
        } else {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->birdsImg, $fileName);
            $fileUrl = 'images/birdsImages/' . $fileName;
        }

       return $fileUrl;
    }
}