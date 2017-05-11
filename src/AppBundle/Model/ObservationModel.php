<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as NaoAssert;


/**
 * ObservationModel
 *
 * @NaoAssert\OutOfFrance
 */


class ObservationModel
{
    /**
     * @Assert\LessThanOrEqual("today UTC",
     *     message = "Vous avez saisi une date future, merci de corriger votre saisie"
     * )
     */
    public $date;
    /**
     * @Assert\Range(
     *      min = 41.56,
     *      max = 51.56,
     *      minMessage = "Vous devez entrer une latitude minimale de {{ limit }}",
     *      maxMessage = "Vous devez entrer une latitude maximale de {{ limit }}",
     *  )
     */
    public $lat;
    /**
     * @Assert\Range(
     *      min = -9.88,
     *      max = 10.21,
     *      minMessage = "Vous devez entrer une longitude minimale de {{ limit }}",
     *      maxMessage = "Vous devez entrer une longitude maximale de {{ limit }}",
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
    public $birdName;
    public $birdId;

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

    public function getLongLat() {
        //Output from this is used with POINT_STR in DQL so must be in specific format
        return sprintf('POINT(%f %f)', $this->long, $this->lat);
    }
}