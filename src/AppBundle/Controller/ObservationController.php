<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Observation;
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

            $imageURL = $this->get('image_manager')->createObservationImage($observationModel);
            $observation = $this->get('observation_assembleur')->createFromModel($observationModel, $this->getUser(), $imageURL);
            $this->get('observation_manager')->create($observation);
            return $this->redirectToRoute('observation');
        }

        return $this->render('Observation/observation.html.twig', [
            'birds' => $birds,
            'form' => $observationForm
                ->createView()]);
    }

    public function observationEditAction(Request $request, $id){

        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();

        //Créa du formulaire
        $observation = $this->getDoctrine()->getRepository('AppBundle:Observation')->findOneBy(array('id' => $id));
        $observationModel = $this->get('observation_assembleur')->createFromObservation($observation);

        $observationForm = $this->get('form.factory')->create(ObservationType::class,
            $observationModel, ['birdList' => $birds, 'selectedBirdId' => $observation->getBird()->getId()]);

        $observationForm->handleRequest($request);
        if ($observationForm->isSubmitted() && $observationForm->isValid()) {

            //Envoi en traitement Bdd et redirect
            $imageURL = $this->get('image_manager')->createObservationImage($observationModel);
            $observationEdit = $this->get('observation_assembleur')->editObservation($observationModel, $observation, $this->getUser(), $imageURL);
            $this->get('observation_manager')->create($observationEdit);

            return $this->redirectToRoute('account');
        }

        return $this->render('Observation/observationEdit.html.twig', [
            'birds' => $birds,
            'form' => $observationForm
                ->createView()]);

    }

    public function observationRemoveAction(Observation $observation){


        $em = $this->getDoctrine()->getManager();
        $em->remove($observation);
        $em->flush();

        return $this->redirectToRoute('account');
    }

    public function observationValidAction(Observation $observation){

        $observation->setValidated(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('account');
    }
}
