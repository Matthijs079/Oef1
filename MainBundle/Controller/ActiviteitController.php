<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Activiteit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Activiteit controller.
 *
 * @Route("activiteit")
 */
class ActiviteitController extends Controller
{
    /**
     * Lists all activiteit entities.
     *
     * @Route("/", name="activiteit_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $activiteits = $em->getRepository('MainBundle:Activiteit')->findAll();

        return $this->render('@Main/activiteit/index.html.twig', array(
            'activiteits' => $activiteits,
        ));
    }

    /**
     * Creates a new activiteit entity.
     *
     * @Route("/new", name="activiteit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $activiteit = new Activiteit();
        $form = $this->createForm('MainBundle\Form\ActiviteitType', $activiteit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activiteit);
            $em->flush();

            return $this->redirectToRoute('activiteit_show', array('id' => $activiteit->getId()));
        }

        return $this->render('@Main/activiteit/new.html.twig', array(
            'activiteit' => $activiteit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a activiteit entity.
     *
     * @Route("/{id}", name="activiteit_show")
     * @Method("GET")
     */
    public function showAction(Activiteit $activiteit)
    {
        $deleteForm = $this->createDeleteForm($activiteit);

        return $this->render('@Main/activiteit/show.html.twig', array(
            'activiteit' => $activiteit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing activiteit entity.
     *
     * @Route("/{id}/edit", name="activiteit_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Activiteit $activiteit)
    {
        $deleteForm = $this->createDeleteForm($activiteit);
        $editForm = $this->createForm('MainBundle\Form\ActiviteitType', $activiteit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activiteit_edit', array('id' => $activiteit->getId()));
        }

        return $this->render('@Main/activiteit/edit.html.twig', array(
            'activiteit' => $activiteit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a activiteit entity.
     *
     * @Route("/{id}", name="activiteit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Activiteit $activiteit)
    {
        $form = $this->createDeleteForm($activiteit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activiteit);
            $em->flush();
        }

        return $this->redirectToRoute('activiteit_index');
    }

    /**
     * Creates a form to delete a activiteit entity.
     *
     * @param Activiteit $activiteit The activiteit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Activiteit $activiteit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('activiteit_delete', array('id' => $activiteit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
