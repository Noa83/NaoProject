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
        //Recup liste oiseaux et injection dans le formulaire créé.
        $birds = $this->getDoctrine()->getRepository('AppBundle:Birds')->getBirdsList();
        $observationModel = new ObservationModel();
        $observationForm = $this->get('form.factory')->create(ObservationType::class,
            $observationModel, ['birdList' => $birds]);

        if ($request->isMethod('POST') && $observationForm->handleRequest($request)->isValid()) {
            //
            $geo = $this->getDoctrine()->getRepository('AppBundle:Km10')->getMailleNativeSql($observationModel->getLatLong());
            $observationModel->setNomMaille($geo);
            dump($geo);

            $file = $observationModel->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('birds_images'), $fileName);
            $fileUrl = 'web/images/birdsImages/'.$fileName.'\'';
            dump($fileUrl);
            dump($fileName);

           // $this->get('observation.recording')->persist($observationModel);
            dump($observationModel);

            //dump($this->generateUrl('birds_images_list'));
//            return $this->redirect($this->generateUrl('birds_images_list'));

            //return $this->redirectToRoute('observation');
        }
        return $this->render('Observation/observation.html.twig', [
            'birds' => $birds,
            'form' => $observationForm
                ->createView(),]);
    }
}