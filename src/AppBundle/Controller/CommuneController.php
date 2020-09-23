<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commune;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commune controller.
 *
 */
class CommuneController extends Controller
{
    /**
     * Lists all commune entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $communes = $em->getRepository('AppBundle:Commune')->findAll();

        return $this->render('commune/index.html.twig', array(
            'communes' => $communes,
        ));
    }

    /**
     * Creates a new commune entity.
     *
     */
    public function newAction(Request $request)
    {
        $commune = new Commune();
        $form = $this->createForm('AppBundle\Form\CommuneType', $commune);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commune);
            $em->flush();

            return $this->redirectToRoute('commune_show', array('id' => $commune->getId()));
        }

        return $this->render('commune/new.html.twig', array(
            'commune' => $commune,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commune entity.
     *
     */
    public function showAction(Commune $commune)
    {
        $deleteForm = $this->createDeleteForm($commune);

        return $this->render('commune/show.html.twig', array(
            'commune' => $commune,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commune entity.
     *
     */
    public function editAction(Request $request, Commune $commune)
    {
        $deleteForm = $this->createDeleteForm($commune);
        $editForm = $this->createForm('AppBundle\Form\CommuneType', $commune);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commune_edit', array('id' => $commune->getId()));
        }

        return $this->render('commune/edit.html.twig', array(
            'commune' => $commune,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commune entity.
     *
     */
    public function deleteAction(Request $request, Commune $commune)
    {
        $form = $this->createDeleteForm($commune);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commune);
            $em->flush();
        }

        return $this->redirectToRoute('commune_index');
    }

    /**
     * Creates a form to delete a commune entity.
     *
     * @param Commune $commune The commune entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commune $commune)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commune_delete', array('id' => $commune->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
