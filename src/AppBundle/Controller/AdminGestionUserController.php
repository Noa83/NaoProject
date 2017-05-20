<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserAdminDashboardType;
use AppBundle\Model\UserAdminModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminGestionUserController extends Controller
{

    /**
     * @Route("/admin/utilisateurs", name="admin_user")
     */
    public function adminGestionUserAction(Request $request)
    {

        $username = $request->query->get('username');
        $user = new User();
        $userModel = new UserAdminModel();
        $formEditUser = $this->createForm(UserAdminDashboardType::class, $userModel);

        if (isset($username) && ($username !== "")) {

            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username' => $username));

            if ($user !== null) {

                $userModel = $this->get('appbundle.user_service')->userToUserAdminModel($user);
                $formEditUser = $this->createForm(UserAdminDashboardType::class, $userModel);
            }else {
                $this->addFlash(
                    'warning',
                    'Pseudo non trouvé veuillez rééssayer.'
                );
            }
        }

        $formEditUser->handleRequest($request);
        if ($formEditUser->isSubmitted() && $formEditUser->isValid()) {

            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username' => $userModel->username));

            dump($user);
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
    public function removeUserAction($id)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);

            if ($user->getRoles() !== array("ROLE_SUPER_ADMIN")) {
                dump($user);
                $em = $this->getDoctrine()->getManager();
                $em->remove($user);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Utilisateur supprimé'
                );
                return $this->redirectToRoute('admin_user');
                
            } else {
                $this->addFlash(
                    'warning',
                    'Vous ne pouvez pas supprimer le compte Super Admin.'
                );
                return $this->redirectToRoute('admin_user');
            }
        }
    }
}