<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Hoogseizoen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Hoogseizoen controller.
 *
 * @Route("hoogseizoen")
 */
class HoogseizoenController extends Controller
{
    /**
     * Lists all hoogseizoen entities.
     *
     * @Route("/", name="hoogseizoen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hoogseizoens = $em->getRepository('MainBundle:Hoogseizoen')->findAll();

        return $this->render('hoogseizoen/index.html.twig', array(
            'hoogseizoens' => $hoogseizoens,
        ));
    }

    /**
     * Creates a new hoogseizoen entity.
     *
     * @Route("/new", name="hoogseizoen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $hoogseizoen = new Hoogseizoen();
        $form = $this->createForm('MainBundle\Form\HoogseizoenType', $hoogseizoen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hoogseizoen);
            $em->flush();

            return $this->redirectToRoute('hoogseizoen_show', array('id' => $hoogseizoen->getId()));
        }

        return $this->render('hoogseizoen/new.html.twig', array(
            'hoogseizoen' => $hoogseizoen,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a hoogseizoen entity.
     *
     * @Route("/{id}", name="hoogseizoen_show")
     * @Method("GET")
     */
    public function showAction(Hoogseizoen $hoogseizoen)
    {
        $deleteForm = $this->createDeleteForm($hoogseizoen);

        return $this->render('hoogseizoen/show.html.twig', array(
            'hoogseizoen' => $hoogseizoen,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing hoogseizoen entity.
     *
     * @Route("/{id}/edit", name="hoogseizoen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Hoogseizoen $hoogseizoen)
    {
        $deleteForm = $this->createDeleteForm($hoogseizoen);
        $editForm = $this->createForm('MainBundle\Form\HoogseizoenType', $hoogseizoen);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hoogseizoen_edit', array('id' => $hoogseizoen->getId()));
        }

        return $this->render('hoogseizoen/edit.html.twig', array(
            'hoogseizoen' => $hoogseizoen,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a hoogseizoen entity.
     *
     * @Route("/{id}", name="hoogseizoen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Hoogseizoen $hoogseizoen)
    {
        $form = $this->createDeleteForm($hoogseizoen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hoogseizoen);
            $em->flush();
        }

        return $this->redirectToRoute('hoogseizoen_index');
    }

    /**
     * Creates a form to delete a hoogseizoen entity.
     *
     * @param Hoogseizoen $hoogseizoen The hoogseizoen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Hoogseizoen $hoogseizoen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hoogseizoen_delete', array('id' => $hoogseizoen->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
