<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Birds
 *
 * @ORM\Table(name="birds")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BirdsRepository")
 *
 */

class Birds
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="regne", type="string", nullable=true, length=8)
     *
     */
    private $regne;

    /**
     * @var string
     *
     * @ORM\Column(name="phylum", type="string", nullable=true, length=8)
     */
    private $phylum;

    /**
     * @var string
     *
     * @ORM\Column(name="classe", type="string", nullable=true, length=4)
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="ordre", type="string", nullable=true, length=19)
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="famille", type="string", nullable=true, length=17)
     */
    private $famille;

    /**
     * @var int
     *
     * @ORM\Column(name="cd_nom", type="integer",  nullable=true)
     */
    private $cdNom;

    /**
     * @var int
     *
     * @ORM\Column(name="cd_taxsup", type="integer", nullable=true)
     */
    private $cdTaxsup;

    /**
     * @var int
     *
     * @ORM\Column(name="cd_ref", type="integer", nullable=true)
     */
    private $cdRef;

    /**
     * @var string
     *
     * @ORM\Column(name="rang", type="string", nullable=true, length=4)
     */
    private $rang;

    /**
     * @var string
     *
     * @ORM\Column(name="lb_nom", type="string", nullable=true, length=44)
     */
    private $lbNom;

    /**
     * @var string
     *
     * @ORM\Column(name="lb_auteur", type="string", nullable=true, length=31)
     */
    private $lbAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_complet", type="string", nullable=true, length=63)
     */
    private $nomComplet;
    /**
     * @var string
     *
     * @ORM\Column(name="nom_valide", type="string", nullable=true, length=56)
     */
    private $nomValide;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_vern", type="string", nullable=true, length=63)
     */
    private $nomVern;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_vern_eng", type="string", nullable=true, length=57)
     */
    private $nomVernEng;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRegne(): string
    {
        return $this->regne;
    }

    /**
     * @return string
     */
    public function getPhylum(): string
    {
        return $this->phylum;
    }

    /**
     * @return string
     */
    public function getClasse(): string
    {
        return $this->classe;
    }

    /**
     * @return string
     */
    public function getOrdre(): string
    {
        return $this->ordre;
    }

    /**
     * @return string
     */
    public function getFamille(): string
    {
        return $this->famille;
    }

    /**
     * @return int
     */
    public function getCdNom(): int
    {
        return $this->cdNom;
    }

    /**
     * @return int
     */
    public function getCdTaxsup(): int
    {
        return $this->cdTaxsup;
    }

    /**
     * @return int
     */
    public function getCdRef(): int
    {
        return $this->cdRef;
    }

    /**
     * @return string
     */
    public function getRang(): string
    {
        return $this->rang;
    }

    /**
     * @return string
     */
    public function getLbNom(): string
    {
        return $this->lbNom;
    }

    /**
     * @return string
     */
    public function getLbAuteur(): string
    {
        return $this->lbAuteur;
    }

    /**
     * @return string
     */
    public function getNomComplet(): string
    {
        return $this->nomComplet;
    }

    /**
     * @return string
     */
    public function getNomValide(): string
    {
        return $this->nomValide;
    }

    /**
     * @return string
     */
    public function getNomVern(): string
    {
        return $this->nomVern;
    }

    /**
     * @return string
     */
    public function getNomVernEng(): string
    {
        return $this->nomVernEng;
    }

}