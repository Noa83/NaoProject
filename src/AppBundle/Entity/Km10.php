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
    private $nom_maille;

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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNomMaille()
    {
        return $this->nom_maille;
    }

    /**
     * @param string $nom_maille
     */
    public function setNomMaille($nom_maille)
    {
        $this->nom_maille = $nom_maille;
    }

    /**
     * @return \_CouchbaseSpatialViewQuery
     */
    public function getPolygon()
    {
        return $this->polygon;
    }

    /**
     * @param \_CouchbaseSpatialViewQuery $polygon
     */
    public function setPolygon($polygon)
    {
        $this->polygon = $polygon;
    }

}