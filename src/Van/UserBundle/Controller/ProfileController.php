<?php

namespace Van\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Van\ResourceBundle\Entity\Blueprint;
use Van\ResourceBundle\Form\Type\BlueprintType;

class ProfileController extends Controller
{
    public function indexAction(Request $request)
    {
        $blueprintForm = $this->createForm(new BlueprintType(), $blueprint = new Blueprint());

        if ("POST" == $request->getMethod()) {
            $blueprintForm->handleRequest($request);

            if ($blueprintForm->isValid()) {
                try {
                    $em = $this->getDoctrine()->getEntityManager();
                    $blueprint->setUploadedBy($this->getUser());

                    $this->get('van_upload.uploader')->upload($blueprint, $randomize = false);
                    $em->persist($blueprint);
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('success', 'Blueprint successfully uploaded.');

                    return $this->redirect($this->generateUrl('van_user_profile'));
                } catch (\Exception $e) {
                    $request->getSession()->getFlashBag()->add('danger', 'Error occured: ' .$e->getMessage());
                }
            }
        }

        return $this->render('VanUserBundle:Profile:index.html.twig', [
            'blueprintForm' => $blueprintForm->createView(),
        ]);
    }
}
