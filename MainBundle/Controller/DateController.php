<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Date;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Date controller.
 *
 * @Route("date")
 */
class DateController extends Controller
{
    /**
     * Lists all date entities.
     *
     * @Route("/", name="date_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dates = $em->getRepository('MainBundle:Date')->findAll();

        return $this->render('@Main/date/index.html.twig', array(
            'dates' => $dates,
        ));
    }

    /**
     * Creates a new date entity.
     *
     * @Route("/new", name="date_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $date = new Date();
        $form = $this->createForm('MainBundle\Form\DateType', $date);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($date);
            $em->flush();

            return $this->redirectToRoute('date_show', array('id' => $date->getId()));
        }

        return $this->render('@Main/date/new.html.twig', array(
            'date' => $date,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a date entity.
     *
     * @Route("/{id}", name="date_show")
     * @Method("GET")
     */
    public function showAction(Date $date)
    {
        $deleteForm = $this->createDeleteForm($date);

        return $this->render('@Main/date/show.html.twig', array(
            'date' => $date,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing date entity.
     *
     * @Route("/{id}/edit", name="date_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Date $date)
    {
        $deleteForm = $this->createDeleteForm($date);
        $editForm = $this->createForm('MainBundle\Form\DateType', $date);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('date_edit', array('id' => $date->getId()));
        }

        return $this->render('@Main/date/edit.html.twig', array(
            'date' => $date,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a date entity.
     *
     * @Route("/{id}", name="date_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Date $date)
    {
        $form = $this->createDeleteForm($date);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($date);
            $em->flush();
        }

        return $this->redirectToRoute('date_index');
    }

    /**
     * Creates a form to delete a date entity.
     *
     * @param Date $date The date entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Date $date)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('date_delete', array('id' => $date->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
