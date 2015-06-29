<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Van\UserBundle\Entity\User;
use Van\UserBundle\Form\Type\RegistrationType;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $latestBlueprints = $em->getRepository('VanResourceBundle:Blueprint')->getLatest(6);

        return $this->render('AppBundle:Default:index.html.twig', [
            'latestBlueprints' => $latestBlueprints,
        ]);
    }

    public function detailsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blueprint = $em->getRepository('VanResourceBundle:Blueprint')->find($id);

        return $this->render('AppBundle:Default:details.html.twig', [
            'blueprint' =>$blueprint,
        ]);
    }
}
