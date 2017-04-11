<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as NaoAssert;


/**
 * ObservationModel
 *
 * @ORM\MappedSuperClass
 *
 * @NaoAssert\OutOfFrance
 */


class ObservationModel
{
    public $date;
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
    public $comment;


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
        $this->setDate(new \DateTime());
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getLongLat()
    {
        return $longLat = $this->long.' '.$this->lat;
    }
}