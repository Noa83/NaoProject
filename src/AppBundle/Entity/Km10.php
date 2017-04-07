<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Km10
 *
 * @ORM\Table(name="km10")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Km10Repository")
 */
class Km10
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_maille", type="string", length=255)
     */
    private $nomMaille;

    /**
     * @var \_CouchbaseSpatialViewQuery
     *
     * @ORM\Column(name="polygon", type="polygon")
     */
    private $polygon;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNomMaille()
    {
        return $this->nomMaille;
    }

    /**
     * @return \_CouchbaseSpatialViewQuery
     */
    public function getPolygon()
    {
        return $this->polygon;
    }
}