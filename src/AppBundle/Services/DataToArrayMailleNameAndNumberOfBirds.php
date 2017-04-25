<?php

namespace AppBundle\Services;

class DataToArrayMailleNameAndNumberOfBirds
{
    public function GetArrayMailleNameAndNumberOfBirds($Km10List)
    {
        $countList = [];
        foreach ($Km10List as $Km10){
            $mailleAndCount = [];
            $compte = count($Km10->getObservations());
            $nomMaille = $Km10->getNomMaille();
            array_push($mailleAndCount, $nomMaille);
            array_push($mailleAndCount, $compte);
            array_push($countList, $mailleAndCount);
        }
        return $countList;
    }
}