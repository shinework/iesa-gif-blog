<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
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
