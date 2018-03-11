<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Periode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Periode controller.
 *
 * @Route("periode")
 */
class PeriodeController extends Controller
{
    /**
     * Lists all periode entities.
     *
     * @Route("/", name="periode_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $periodes = $em->getRepository('MainBundle:Periode')->findAll();

        return $this->render('@Main/periode/index.html.twig', array(
            'periodes' => $periodes,
        ));
    }

    /**
     * Creates a new periode entity.
     *
     * @Route("/new", name="periode_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $periode = new Periode();
        $form = $this->createForm('MainBundle\Form\PeriodeType', $periode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($periode);
            $em->flush();

            return $this->redirectToRoute('periode_show', array('id' => $periode->getId()));
        }

        return $this->render('@Main/periode/new.html.twig', array(
            'periode' => $periode,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a periode entity.
     *
     * @Route("/{id}", name="periode_show")
     * @Method("GET")
     */
    public function showAction(Periode $periode)
    {
        $deleteForm = $this->createDeleteForm($periode);

        return $this->render('@Main/periode/show.html.twig', array(
            'periode' => $periode,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing periode entity.
     *
     * @Route("/{id}/edit", name="periode_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Periode $periode)
    {
        $deleteForm = $this->createDeleteForm($periode);
        $editForm = $this->createForm('MainBundle\Form\PeriodeType', $periode);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('periode_edit', array('id' => $periode->getId()));
        }

        return $this->render('@Main/periode/edit.html.twig', array(
            'periode' => $periode,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a periode entity.
     *
     * @Route("/{id}", name="periode_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Periode $periode)
    {
        $form = $this->createDeleteForm($periode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($periode);
            $em->flush();
        }

        return $this->redirectToRoute('periode_index');
    }

    /**
     * Creates a form to delete a periode entity.
     *
     * @param Periode $periode The periode entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Periode $periode)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('periode_delete', array('id' => $periode->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
