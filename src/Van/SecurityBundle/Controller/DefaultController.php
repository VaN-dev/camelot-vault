<?php

namespace Van\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VanSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
}
