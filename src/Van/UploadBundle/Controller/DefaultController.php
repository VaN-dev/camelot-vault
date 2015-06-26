<?php

namespace Van\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VanUploadBundle:Default:index.html.twig', array('name' => $name));
    }
}
