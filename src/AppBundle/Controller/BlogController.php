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
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy(['isPublished' => true]);

        return $this->render('AppBundle:Blog:index.html.twig', [
            'posts' => $posts
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
