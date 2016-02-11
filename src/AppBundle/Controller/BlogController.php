<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $query = $this->getDoctrine()->getRepository(Post::class)->getPublishedGifQuery();

        $paginator  = $this->get('knp_paginator');
        $postsPaginated = $paginator->paginate($query, $request->query->get('page', 1), 6);

        return $this->render('AppBundle:Blog:index.html.twig', [
            'postsPaginated' => $postsPaginated
        ]);
    }

    /**
     * @Route("/view/{idPost}", name="view_post")
     */
    public function viewAction($idPost)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($idPost);

        return $this->render('AppBundle:Blog:view.html.twig', array(
            'post' => $post
        ));
    }
}
