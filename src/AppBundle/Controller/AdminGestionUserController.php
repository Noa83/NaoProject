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

        $username = $request->query->get('username');
        $user = new User();
        $userModel = new UserAccountModel();
        $formEditUser = $this->createForm(UserAdminDashboardType::class, $userModel);

        if (isset($username) && ($username != "")) {

            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username' => $username));

            if ($user != null) {

                $userModel = $this->get('appbundle.user_service')->userToUserModel($user);
                $formEditUser = $this->createForm(UserAdminDashboardType::class, $userModel);
            }else {
                $this->addFlash(
                    'warning',
                    'Pseudo non trouvé veuillez rééssayer.'
                );
            }
        }

        $formEditUser->handleRequest($request);
        if ($formEditUser->isSubmitted()) {

            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username' => $userModel->username));

            $this->get('appbundle.user_service')->AdminModifyUser($user, $userModel);
            $this->addFlash(
                'success',
                'Changements sauvegardés'
            );
        }

        return $this->render('AdminAccount/adminGestionUser.html.twig', array(
            'formEditUser' => $formEditUser->createView(),
            'user' => $user));
    }

    /**
     * @Route("/admin/user/remove/{id}", name="user_remove", requirements={"id": "\d+"})
     */
    public function removeUser($id){

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash(
            'success',
            'Utilisateur supprimé'
        );

        return $this->redirectToRoute('admin_user');
    }
}