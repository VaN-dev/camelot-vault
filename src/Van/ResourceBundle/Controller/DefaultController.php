<?php

namespace Van\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function downloadBlueprintAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blueprint = $em->getRepository('VanResourceBundle:Blueprint')->find($id);

        if (null === $blueprint) {
            throw new \Exception("Can't find blueprint");
        }

        $blueprint->setDownloaded($blueprint->getDownloaded() + 1);
        $em->flush();

        $path = $blueprint->getWebPath();

        $response = new Response();
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($path));
        $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($path) . '";');
        $response->headers->set('Content-length', filesize($path));
        $response->sendHeaders();
        $response->setContent(readfile($path));

        return $response;
    }
}
