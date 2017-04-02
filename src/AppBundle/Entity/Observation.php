<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Observation
 *
 * @ORM\Table(name="observation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Birds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bird;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     *
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="latLong", type="string", length=255)
     */
    private $latLong;

    /**
     * @var string
     *
     * @ORM\Column(name="nomMaille", type="string", length=255)
     */
    private $nomMaille;

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="text")
     */
    private $msg;


   // private $idUser;

    /**
     * @var bool
     *
     * @ORM\Column(name="validated", type="boolean")
     */
    private $validated;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="text")
     */
    private $imageUrl;

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }


    /**
     * @return mixed
     */
    public function getBird()
    {
        return $this->bird;
    }

    /**
     * @param mixed $bird
     */
    public function setBird($bird)
    {
        $this->bird = $bird;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Set latLong
     *
     * @param string $latLong
     *
     * @return Observation
     */
    public function setLatLong($latLong)
    {
        $this->latLong = $latLong;

        return $this;
    }

    /**
     * Get latLong
     *
     * @return string
     */
    public function getLatLong()
    {
        return $this->latLong;
    }

    /**
     * Set nomMaille
     *
     * @param string $nomMaille
     *
     * @return Observation
     */
    public function setNomMaille($nomMaille)
    {
        $this->nomMaille = $nomMaille;

        return $this;
    }

    /**
     * Get nomMaille
     *
     * @return string
     */
    public function getNomMaille()
    {
        return $this->nomMaille;
    }

    /**
     * Set msg
     *
     * @param string $msg
     *
     * @return Observation
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param mixed $validated
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }
}

