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
    public $observationDate;
    /**
     * @Assert\Range(
     *      min = 41.56,
     *      max = 51.56,
     *      minMessage = "Vous devez entrer une coordonnée minimale de {{ limit }}",
     *      maxMessage = "Vous devez entrer une coordonnée maximale de {{ limit }}",
     *  )
     */
    public $lat;
    /**
     * @Assert\Range(
     *      min = -9.88,
     *      max = 10.21,
     *      minMessage = "Vous devez entrer une coordonnée minimale de {{ limit }}",
     *      maxMessage = "Vous devez entrer une coordonnée maximale de {{ limit }}",
     *  )
     */
    public $long;
    public $maille;
    public $observationComment;


    /**
     * @Assert\Image(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/gif"},
     *     mimeTypesMessage = "Ce fichier n'est pas une photo.",
     *     maxSizeMessage = "Le fichier est trop lourd ({{ size }})MB."
     * )
     */
    public $image;
    public $bird;

    public function __construct()
    {
        $this->setObservationDate(new \DateTime());
    }

    /**
     * @param mixed $observationDate
     */
    public function setObservationDate($observationDate)
    {
        $this->observationDate = $observationDate;
    }

    /**
     * @return string
     */
    public function getLongLat(): string
    {
        return $longLat = $this->long.' '.$this->lat;
    }

    /**
     * @param mixed $nomMaille
     */
    public function setMaille($maille)
    {
        $this->maille = $maille;
    }
}