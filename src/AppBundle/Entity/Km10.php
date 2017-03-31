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

    private $polygon_geo;
}