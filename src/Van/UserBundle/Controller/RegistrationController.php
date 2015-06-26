<?php

namespace Van\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Van\UserBundle\Entity\User;
use Van\UserBundle\Form\Type\RegistrationType;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new RegistrationType(), $user = new User());

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Password encoding
                $passwordEncoding = $this->container->get('van_security.password_encoder');
                $user->setPassword($passwordEncoding->encodePassword($user->getPlainPassword(), $user->getSalt()));

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $request->getSession()->getFlashBag()->add('success', '<strong>Well done!</strong> You successfully registered.');

                return $this->redirect($this->generateUrl('index'));
            }
        }

        return $this->render('VanUserBundle:Registration:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
