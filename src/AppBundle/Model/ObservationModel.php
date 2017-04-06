<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * ObservationModel
 *
 * @ORM\MappedSuperClass
 */

class ObservationModel
{
    private $date;
    /**
     * @Assert\Range(
     *      min = 41.56,
     *      max = 51.56,
     *      minMessage = "Vous devez entrer une coordonnée minimale de {{ limit }}",
     *      maxMessage = "Vous devez entrer une coordonnée maximale de {{ limit }}",
     *  )
     */
    private $lat;
    /**
     * @Assert\Range(
     *      min = -9.88,
     *      max = 10.21,
     *      minMessage = "Vous devez entrer une coordonnée minimale de {{ limit }}",
     *      maxMessage = "Vous devez entrer une coordonnée maximale de {{ limit }}",
     *  )
     */
    private $long;
    private $nomMaille;
    private $observationMsg;


    /**
     * @Assert\Image(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/gif"},
     *     mimeTypesMessage = "Ce fichier n'est pas une photo.",
     *     maxSizeMessage = "Le fichier est trop lourd ({{ size }})MB."
     * )
     */
    private $image;
    private $idUser;
    private $birds;

    /**
     * @return mixed
     */
    public function getBirds()
    {
        return $this->birds;
    }

    /**
     * @param mixed $birds
     */
    public function setBirds($birds)
    {
        $this->birds = $birds;
    }


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
    public function getLongLat()
    {
        return $longLat = $this->long.' '.$this->lat;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @param mixed $long
     */
    public function setLong($long)
    {
        $this->long = $long;
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