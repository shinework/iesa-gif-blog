<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\ProposePostType;
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
    public function addAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(new ProposePostType(), $post);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {

                // Save the proposition
                $post->setCreatedAt(new \DateTime());
                $post->setIsPublished(false);

                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_list_post'));
            }
        }

        return $this->render('AppBundle:Admin:add.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
