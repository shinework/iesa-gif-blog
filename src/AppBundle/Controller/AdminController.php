<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
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
     * @Route("/admin/login-check", name="login_check")
     */
    public function loginCheckAction()
    {
    }

    /**
    * @Route("/admin/logout", name="logout")
    */
    public function logoutAction()
    {
    }

    /**
     * @Route("/admin/list", name="admin_list_post")
     */
    public function listAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('AppBundle:Admin:list.html.twig', array(
            'posts' => $posts
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
