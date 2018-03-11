<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MainBundle\Entity\Kamer;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kamers = $em->getRepository('MainBundle:Kamer')->findAll();
        $images = $em->getRepository('MainBundle:Image')->findAll();
        $activiteits = $em->getRepository('MainBundle:Activiteit')->findBy(array(), array('id' => 'DESC'), 2);

        return $this->render('MainBundle:Default:index.html.twig', array(
            'kamers' => $kamers,
            'images' => $images,
            'activiteits' => $activiteits,
        ));
    }
}
