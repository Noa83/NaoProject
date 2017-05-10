<?php

namespace AppBundle\Services;



class DataToArrayOfObjectsForAutocompleteConsultation
{
    public function getBirdsListForAutoComplete($birdsArray)
    {
        $birdsList = [];

        foreach ($birdsArray as $birdName => $birdId){
            $birdTemp = [
                'label' => $birdName,
                'id' => $birdId
            ];
            array_push($birdsList, $birdTemp);
        }
        return $birdsList;
    }
}