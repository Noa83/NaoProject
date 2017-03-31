<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * ObservationModel
 *
 * @ORM\MappedSuperClass
 */

class ObservationModel
{
    private $date;
    private $specie;
    private $latLong;
    private $nomMaille;
    private $observationMsg;
    private $image;
    private $idUser;


    public function __construct()
    {
        $this->setDate(new \DateTime());
    }


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getSpecie()
    {
        return $this->specie;
    }

    /**
     * @param mixed $specie
     */
    public function setSpecie($specie)
    {
        $this->specie = $specie;
    }

    /**
     * @return mixed
     */
    public function getLatLong()
    {
        return $this->latLong;
    }

    /**
     * @param mixed $latLong
     */
    public function setLatLong($latLong)
    {
        $this->latLong = $latLong;
    }

    /**
     * @return mixed
     */
    public function getNomMaille()
    {
        return $this->nomMaille;
    }

    /**
     * @param mixed $nomMaille
     */
    public function setNomMaille($nomMaille)
    {
        $this->nomMaille = $nomMaille;
    }

    /**
     * @return mixed
     */
    public function getObservationMsg()
    {
        return $this->observationMsg;
    }

    /**
     * @param mixed $observationMsg
     */
    public function setObservationMsg($observationMsg)
    {
        $this->observationMsg = $observationMsg;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }



}