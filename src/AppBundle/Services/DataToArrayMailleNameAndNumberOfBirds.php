<?php

namespace AppBundle\Services;

class DataToArrayMailleNameAndNumberOfBirds
{
    public function GetArrayMailleNameAndNumberOfBirds($Km10List)
    {
        $countList = [];
        $countNbObsTotale = 0;

        foreach ($Km10List as $Km10){
            $mailleAndCount = [];
            $compte = count($Km10->getObservations());
            $nomMaille = $Km10->getNomMaille();
            array_push($mailleAndCount, $nomMaille);
            array_push($mailleAndCount, $compte);
            array_push($countList, $mailleAndCount);
            $countNbObsTotale += $compte;
        }
        return array($countList,$countNbObsTotale);
    }

}