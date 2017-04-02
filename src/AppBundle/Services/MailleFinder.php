<?php

namespace AppBundle\Services;

use Doctrine\ORM\Mapping as ORM;

class MailleFinder
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function find($latLong)
    {

    }
}