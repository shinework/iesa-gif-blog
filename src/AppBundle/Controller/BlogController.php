<?php

namespace AppBundle\Controller;

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
        // replace this example code with whatever you need
        return $this->render('AppBundle:Blog:index.html.twig', array(
        ));
    }

    /**
     * @Route("/view/{idPost}", name="view_post")
     */
    public function viewAction($idPost)
    {
        return $this->render('AppBundle:Blog:view.html.twig', array(
        ));
    }
}
