<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hopital;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Hopital controller.
 *
 */
class HopitalController extends Controller
{
    /**
     * Lists all hopital entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hopitals = $em->getRepository('AppBundle:Hopital')->findAll();

        return $this->render('hopital/index.html.twig', array(
            'hopitals' => $hopitals,
        ));
    }

    /**
     * Creates a new hopital entity.
     *
     */
    public function newAction(Request $request)
    {
        $hopital = new Hopital();
        $form = $this->createForm('AppBundle\Form\HopitalType', $hopital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hopital);
            $em->flush();

            return $this->redirectToRoute('hopital_show', array('id' => $hopital->getId()));
        }

        return $this->render('hopital/new.html.twig', array(
            'hopital' => $hopital,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a hopital entity.
     *
     */
    public function showAction(Hopital $hopital)
    {
        $deleteForm = $this->createDeleteForm($hopital);

        return $this->render('hopital/show.html.twig', array(
            'hopital' => $hopital,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing hopital entity.
     *
     */
    public function editAction(Request $request, Hopital $hopital)
    {
        $deleteForm = $this->createDeleteForm($hopital);
        $editForm = $this->createForm('AppBundle\Form\HopitalType', $hopital);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hopital_edit', array('id' => $hopital->getId()));
        }

        return $this->render('hopital/edit.html.twig', array(
            'hopital' => $hopital,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a hopital entity.
     *
     */
    public function deleteAction(Request $request, Hopital $hopital)
    {
        $form = $this->createDeleteForm($hopital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hopital);
            $em->flush();
        }

        return $this->redirectToRoute('hopital_index');
    }

    /**
     * Creates a form to delete a hopital entity.
     *
     * @param Hopital $hopital The hopital entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Hopital $hopital)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hopital_delete', array('id' => $hopital->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
