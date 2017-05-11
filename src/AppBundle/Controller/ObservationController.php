<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Observation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\ObservationType;
use AppBundle\Model\ObservationModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class ObservationController extends Controller
{
    /**
     * @Route("/observation", name="observation")
     */
    public function observationAction(Request $request)
    {
        $observationModel = new ObservationModel();
        $observationForm = $this->get('form.factory')->create(ObservationType::class,
            $observationModel);

        if ($request->isMethod('POST') && $observationForm->handleRequest($request)->isValid()) {

            $imageURL = $this->get('image_manager')->createObservationImage($observationModel);
            $observation = $this->get('observation_assembleur')->createFromModel($observationModel, $this->getUser(), $imageURL);
            $this->get('observation_manager')->create($observation);

            $this->addFlash('success', 'Votre observation a bien été enregistrée!');
            return $this->redirectToRoute('account_observation');
        }

        return $this->render('Observation/observation.html.twig', [
            'form' => $observationForm
                ->createView()]);
    }

    /**
     * @Route("/observation/edit/{id}", name="observation_edit", requirements={"id": "\d+"})
     */
    public function observationEditAction(Request $request, $id)
    {
        $observation = $this->getDoctrine()->getRepository('AppBundle:Observation')->findOneBy(array('id' => $id));
        $observationModel = $this->get('observation_assembleur')->createFromObservation($observation);

        $observationForm = $this->get('form.factory')->create(ObservationType::class,
            $observationModel);

        $observationForm->handleRequest($request);
        if ($observationForm->isSubmitted() && $observationForm->isValid()) {

            $imageURL = $this->get('image_manager')->createObservationImage($observationModel);
            $observationEdit = $this->get('observation_assembleur')->editObservation($observationModel, $observation, $this->getUser(), $imageURL);
            $this->get('observation_manager')->create($observationEdit);

            return $this->redirectToRoute('account');
        }

        return $this->render('Observation/observationEdit.html.twig', [
            'form' => $observationForm
                ->createView()]);

    }

    /**
     * @Route("/observation/remove/{id}", name="observation_remove", requirements={"id": "\d+"})
     */
    public function observationRemoveAction(Observation $observation){


        $em = $this->getDoctrine()->getManager();
        $em->remove($observation);
        $em->flush();

        return $this->redirectToRoute('account');
    }

    /**
     * @Route("/observation/validate/{id}", name="observation_validate", requirements={"id": "\d+"})
     */
    public function observationValidAction(Observation $observation){

        $observation->setValidated(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('account_validation');
    }

}
