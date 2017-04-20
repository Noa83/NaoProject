<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserAdminDashboardType;
use AppBundle\Form\UserSearchType;
use AppBundle\Model\UserAccountModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminGestionUserController extends Controller
{

    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function adminGestionUserAction(Request $request)
    {

        $user = new User();
        $userModel = new UserAccountModel();
        $formSearch = $this->createForm(UserSearchType::class, $userModel);
        $formEditUser = $this->createForm(UserAdminDashboardType::class, $userModel);

        $formSearch->handleRequest($request);
        if ($formSearch->isSubmitted()) {

            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username' => $userModel->username));

            if ($user != null) {

                $userModel = $this->get('appbundle.user_service')->userToUserModel($user);
                $formEditUser = $this->createForm(UserAdminDashboardType::class, $userModel);
            }else {
                $this->addFlash(
                    'alert',
                    'Aucun Pseudo de ce nom.'
                );
            }

            return $this->render('AdminAccount/adminGestionUser.html.twig', array('formSearch' => $formSearch->createView(),
                'formEditUser' => $formEditUser->createView()));
        }

        $formEditUser->handleRequest($request);
        if ($formEditUser->isSubmitted()) {

            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username' => $userModel->username));

            $this->get('appbundle.user_service')->modifyUser($user, $userModel);
            $this->addFlash(
                'notice',
                'Changements sauvegardés'
            );
        }

        return $this->render('AdminAccount/adminGestionUser.html.twig', array('formSearch' => $formSearch->createView(),
            'formEditUser' => $formEditUser->createView()));
    }
}