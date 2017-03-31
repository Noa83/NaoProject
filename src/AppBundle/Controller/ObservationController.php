<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\ObservationType;
use AppBundle\Model\ObservationModel;
use AppBundle\Entity\Birds;
use AppBundle\Entity\Observation;



class ObservationController extends Controller
{
    public function observationAction(Request $request)
    {
        $observationModel = new ObservationModel();
        $observationForm = $this->get('form.factory')->create(ObservationType::class, $observationModel);

        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();

        dump($birds);



        if ($request->isMethod('POST') && $observationForm->handleRequest($request)->isValid()) {

            dump($request);
//            $this->get('observation.persist')->observationPersist();


            //return $this->redirectToRoute('observation');
        }
        return $this->render('Observation/observation.html.twig', [
            'birds' => $birds,
            'formView' => $observationForm
            ->createView(),]);
    }
}