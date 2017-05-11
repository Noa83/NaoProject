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

    public function getJsonMailleNameAndNumberOfBirds($Km10List)
    {
        $cols = [];
        $tempCols1 = [
            'id' => '',
            'label' => 'Nom de la Maille',
            'pattern' => '',
            'type' => 'string'
        ];
        $tempCols2 = [
            'id' => '',
            'label' => 'Nombre d\'individus',
            'pattern' => '',
            'type' => 'number'
        ];
        array_push($cols, $tempCols1, $tempCols2);

        $rows = [];
        foreach ($Km10List as $Km10) {
            $compte = count($Km10->getObservations());
            $nomMaille = $Km10->getNomMaille();

            $tempRows = array(
                'c' => [
                    [
                        'v' => $nomMaille,
                        'f' => null
                    ],
                    [
                        'v' => $compte,
                        'f' => null
                    ]
                ]
            );
            array_push($rows, $tempRows);
        }
        $json = array(
            'cols' => $cols,
            'rows' => $rows
        );
        return $json;
    }

}