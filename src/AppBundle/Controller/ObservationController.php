<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\ObservationType;
use AppBundle\Model\ObservationModel;


class ObservationController extends Controller
{
    public function observationAction(Request $request)
    {
        //Récup liste oiseaux.
        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();

        //Créa du formulaire
        $observationModel = new ObservationModel();
        $observationForm = $this->get('form.factory')->create(ObservationType::class,
            $observationModel, ['birdList' => $birds]);

        //Gestion d'une saisie géo hors France (quand les coordonnées rentrent dans les min/max entrés en conditions)
        if ($request->isMethod('POST') && $observationForm->handleRequest($request)->isValid()) {

                //Envoi en traitement Bdd et redirect
                $this->get('observation.recording')->persist($observationModel, $this->getUser());
                //Adresse de redirection à changer vers la bonne.
                return $this->redirectToRoute('observation');
        }
        return $this->render('Observation/observation.html.twig', [
            'birds' => $birds,
            'form' => $observationForm
                ->createView()]);
    }
}
