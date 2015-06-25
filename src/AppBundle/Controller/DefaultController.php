<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Van\UserBundle\Entity\User;
use Van\UserBundle\Form\Type\UserType;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $registrationForm = $this->createForm(new UserType(), $user = new User());

        return $this->render('AppBundle:Default:index.html.twig', [
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    public function detailsAction()
    {
        return $this->render('AppBundle:Default:details.html.twig');
    }
}
