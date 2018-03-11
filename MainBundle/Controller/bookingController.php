<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Factuur;
use MainBundle\Entity\Regel;
use MainBundle\Entity\User;
use MainBundle\Entity\Kamer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\DateTime;


class bookingController extends Controller
    /**
     * Booking controller.
     *
     * @Route("booking")
     */

{
    /**
     * @Route("/", name="booking")
     */
    public function indexAction()
    {
        // get the cart from  the session
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cart = $session->set('cart', '');
        $cart = $session->get('cart', array());

        // $cart = array_keys($cart);
        // print_r($cart); die;

        // fetch the information using query and ids in the cart
        if ($cart != '') {


            if (isset($cart)) {
                $em = $this->getDoctrine()->getEntityManager();
                $kamers = $em->getRepository('MainBundle:Kamer')->findAll();
            } else {
                return $this->render('@Main/Booking/index.html.twig', array(
                    'empty' => true,
                ));
            }


            return $this->render('@Main/Booking/index.html.twig', array(
                'empty' => false,
                'kamers' => $kamers,
            ));
        } else {
            return $this->render('@Main/Booking/index.html.twig', array(
                'empty' => true,
            ));
        }
    }

    /**
     * @Route("/add/{id}", name="booking_add")
     */
    public function addAction($id)
    {
        // fetch the cart
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('MainBundle:Kamer')->find($id);
        //print_r($product->getId()); die;
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $cart = $session->get('cart', array());

        // check if the $id already exists in it.
        if ($product == NULL) {
            $this->get('session')->setFlash('notice', 'This product is not     available in Stores');
            return $this->redirect($this->generateUrl('booking'));
        } else {
            if (isset($cart[$id])) {

                ++$cart[$id];
                /*  $qtyAvailable = $product->getQuantity();

                  if ($qtyAvailable >= $cart[$id]['quantity'] + 1) {
                      $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
                  } else {
                      $this->get('session')->setFlash('notice', 'Quantity     exceeds the available stock');
                      return $this->redirect($this->generateUrl('cart'));
                  } */
            } else {
                // if it doesnt make it 1
                $cart[$id] = 1;
                //$cart[$id]['quantity'] = 1;
            }

//            if (strlen($dates)>9) {
////                var_dump($dates);
////                die();
//            $datum1 = substr($dates, 0, 10);
//            $datum2 = substr($dates, 13, 10);
//
//            $start = new DateTime($datum1);
//            $eind = new DateTime($datum2);
//
//            $today = new \DateTime('today');
//            if ($start < $today) {
//                $start = $today;
//            }
//            $interval = $start->diff($eind);
//
//            $datum[$id] = $start->format('d-m-Y') . ' - ' . $eind->format('d-m-Y');
//            // nu nog $cart[$id] vullen met datum dagen.
//            $cart[$id] = $interval->days + 1; // omdat de inleverdag ook moet tellen.
//            $session->set('datum', $datum);
//        }

            $session->set('cart', $cart);
            //echo('<pre>');
            //print_r($cart); echo ('</pre>');die();
            return $this->redirect($this->generateUrl('booking'));

        }
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkoutAction()
    {
        // verwerken van regels in de nieuwe factuur voor de huidige klant.
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cart = $session->set('cart', '');
        $cart = $session->get('cart', array());

        // aanmaken factuur regel.
        $em = $this->getDoctrine()->getManager();
        $userAdress = $em->getRepository('MainBundle:User')->findOneBy(array('id' => $this->getUser()->getId()));

        // new UserAdress if no UserAdress found...
        if (!$userAdress) {
            $userAdress = new User();
            $userAdress->setId($this->getUser()->getId());
        }

        $factuur = new Factuur();
        $factuur->setFactuurdatum(new \DateTime("now"));
        $factuur->setUser($this->getUser());

        //var_dump($cart);
        // vullen regels met orderregels.
        // put invoice in dbase.
        if (isset($cart)) {
            // $data = $this->get('request_stack')->getCurrentRequest()->request->all();
            $em->persist($factuur);
            $em->flush();
            // put basket in dbase
            foreach ($cart as $id => $quantity) {
                $regel = new Regel();
                $regel->setFactuur($factuur);

                $em = $this->getDoctrine()->getManager();
                $kamer = $em->getRepository('MainBundle:Kamer')->find($id);

                $regel->setAantal($quantity);
                $regel->setKamer($kamer);

                $em = $this->getDoctrine()->getManager();
                $em->persist($regel);
                $em->flush();
            }
        }


        $session->clear();

        return $this->redirectToRoute('main_default_index');
    }

    /**
     * @Route("/add_days/{days}", name="booking_add_dayes")
     */
    public function adddaysAction($dayes)
    {
        // fetch the cart
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('RacBundle:Auto')->find($id);
        //print_r($product->getId()); die;
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $cart = $session->get('cart', array());
        $datum = $session->get('datum', array());
        //$datum = $session->get('datum', array());

        // check if the $id already exists in it.
        if ($product == NULL) {
            $this->get('session')->setFlash('notice', 'This product is not     available in Stores');
            return $this->redirect($this->generateUrl('cart'));
        } else {
            // ieder rec in cart aantal = dayes
            foreach ($cart as $id => $quantity) {
                $quantity = $dayes;
            }
        }
        $session->set('cart', $cart);

        return $this->render('@Main/Booking/index.html.twig', array(
            'empty' => false,

        ));
    }

    /**
     * @Route("/remove/{id}", name="booking_remove")
     */
    public function removeAction($id)
    {
        // check the cart
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $cart = $session->get('cart', array());

        // if it doesn't exist redirect to cart index page. end
        if(!$cart[$id]) { $this->redirect( $this->generateUrl('booking') ); }

        // check if the $id already exists in it.
        if( isset($cart[$id]) ) {
            $cart[$id] = $cart[$id] - 1;
            if ($cart[$id] < 1) {
                unset($cart[$id]);
            }
        } else {
            return $this->redirect( $this->generateUrl('booking') );
        }

        $session->set('cart', $cart);

        //echo('<pre>');
        //print_r($cart); echo ('</pre>');die();

        return $this->redirect( $this->generateUrl('booking') );
    }


}
