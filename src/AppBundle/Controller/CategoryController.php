<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Van\UserBundle\Entity\User;
use Van\UserBundle\Form\Type\RegistrationType;

class CategoryController extends Controller
{

    /**
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailsAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('VanResourceBundle:Category')->findOneBy(['slug' => $slug]);
        $blueprints = $em->getRepository('VanResourceBundle:Blueprint')->findBy(['category' => $category]);

        return $this->render('VanResourceBundle:Category:category.html.twig', [
            'category' =>$category,
            'blueprints' =>$blueprints,
        ]);
    }
}
