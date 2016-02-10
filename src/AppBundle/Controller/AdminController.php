<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'AppBundle:Admin:login.html.twig', array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/admin/login_check", name="login_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/admin/list", name="admin_list_post")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Admin:list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/admin/add", name="admin_add_post")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Admin:add.html.twig', array(
            // ...
        ));
    }
}
