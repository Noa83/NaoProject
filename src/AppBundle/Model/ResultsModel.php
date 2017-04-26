<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as NaoAssert;

/**
 * ResultsModel
 *
 * @NaoAssert\NoObservationsFound
 */
class ResultsModel
{
    public $bird;
}