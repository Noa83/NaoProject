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
     * @ORM\Column(name="REGNE", type="string", nullable=true, length=8)
     *
     */
    private $REGNE;

    /**
     * @var string
     *
     * @ORM\Column(name="PHYLUM", type="string", nullable=true, length=8)
     */
    private $PHYLUM;

    /**
     * @var string
     *
     * @ORM\Column(name="CLASSE", type="string", nullable=true, length=4)
     */
    private $CLASSE;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDRE", type="string", nullable=true, length=19)
     */
    private $ORDRE;

    /**
     * @var string
     *
     * @ORM\Column(name="FAMILLE", type="string", nullable=true, length=17)
     */
    private $FAMILLE;

    /**
     * @var int
     *
     * @ORM\Column(name="CD_NOM", type="integer",  nullable=true)
     */
    private $CD_NOM;

    /**
     * @var int
     *
     * @ORM\Column(name="CD_TAXSUP", type="integer", nullable=true)
     */
    private $CD_TAXSUP;

    /**
     * @var int
     *
     * @ORM\Column(name="CD_REF", type="integer", nullable=true)
     */
    private $CD_REF;

    /**
     * @var string
     *
     * @ORM\Column(name="RANG", type="string", nullable=true, length=4)
     */
    private $RANG;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_NOM", type="string", nullable=true, length=44)
     */
    private $LB_NOM;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_AUTEUR", type="string", nullable=true, length=31)
     */
    private $LB_AUTEUR;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_COMPLET", type="string", nullable=true, length=63)
     */
    private $NOM_COMPLET;
    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VALIDE", type="string", nullable=true, length=56)
     */
    private $NOM_VALIDE;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN", type="string", nullable=true, length=63)
     */
    private $NOM_VERN;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN_ENG", type="string", nullable=true, length=57)
     */
    private $NOM_VERN_ENG;

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
    public function getREGNE()
    {
        return $this->REGNE;
    }

    /**
     * @return string
     */
    public function getPHYLUM()
    {
        return $this->PHYLUM;
    }

    /**
     * @return string
     */
    public function getCLASSE()
    {
        return $this->CLASSE;
    }

    /**
     * @return string
     */
    public function getORDRE()
    {
        return $this->ORDRE;
    }

    /**
     * @return string
     */
    public function getFAMILLE()
    {
        return $this->FAMILLE;
    }

    /**
     * @return int
     */
    public function getCDNOM()
    {
        return $this->CD_NOM;
    }

    /**
     * @return int
     */
    public function getCDTAXSUP()
    {
        return $this->CD_TAXSUP;
    }

    /**
     * @return int
     */
    public function getCDREF()
    {
        return $this->CD_REF;
    }

    /**
     * @return string
     */
    public function getRANG()
    {
        return $this->RANG;
    }

    /**
     * @return string
     */
    public function getLBNOM()
    {
        return $this->LB_NOM;
    }

    /**
     * @return string
     */
    public function getLBAUTEUR()
    {
        return $this->LB_AUTEUR;
    }

    /**
     * @return string
     */
    public function getNOMCOMPLET()
    {
        return $this->NOM_COMPLET;
    }

    /**
     * @return string
     */
    public function getNOMVALIDE()
    {
        return $this->NOM_VALIDE;
    }

    /**
     * @return string
     */
    public function getNOMVERN()
    {
        return $this->NOM_VERN;
    }

    /**
     * @return string
     */
    public function getNOMVERNENG()
    {
        return $this->NOM_VERN_ENG;
    }



}