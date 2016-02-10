<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin/list")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Admin:list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/admin/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Admin:add.html.twig', array(
            // ...
        ));
    }
}
