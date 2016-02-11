<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;
use AppBundle\Form\ProposePostType;
use AppBundle\Form\ProposeTagType;
use AppBundle\Form\UpdatePostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    /**
     * @Route("/admin/update/{idPost}", name="admin_update_post")
     */
    public function updateAction(Request $request, $idPost)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($idPost);
        $form = $this->createForm(new UpdatePostType(), $post);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_list_post'));
            }
        }

        return $this->render('AppBundle:Admin:update.html.twig', array(
            'form' => $form->createView(),
            'post' => $post,
        ));
    }

    /**
     * @Route("/admin/delete/{idPost}", name="admin_delete_post")
     */
    public function deleteAction(Request $request, $idPost)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($idPost);
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $response = new RedirectResponse($this->get('router')->generate('admin_list_post'));
        return $response;
    }

    /**
     * @Route("/admin/tag/add", name="admin_add_tag")
     */
    public function addTagAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm(new ProposeTagType(), $tag);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_list_post'));
            }
        }

        return $this->render('AppBundle:Admin:addTag.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
