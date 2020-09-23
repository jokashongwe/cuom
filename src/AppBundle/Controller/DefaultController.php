<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $universites=$em->getRepository('AppBundle:Universite')->findAll();
        $hopitaux=$em->getRepository('AppBundle:Hopital')->findAll();
        $specialites=$em->getRepository('AppBundle:Specialite')->findAll();
        $communes=$em->getRepository('AppBundle:Commune')->findAll();
        $statuts=$em->getRepository('AppBundle:Statut')->findAll();
        // replace this example code with whatever you need
        return $this->render('default/search.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        'universites'=>$universites,'hopitaux'=>$hopitaux, 'specialites'=>$specialites, 'communes'=>$communes, 'statuts' => $statuts]);
    }


    public function rechercheTraitementAction(Request $request)
    {
        //$form = $this->createForm(new RechercheType());
        $em = $this->getDoctrine()->getManager();

        if ($request->isXmlHttpRequest() && $request->get('recherche')!= null)
        {

            $motcle=$request->get('recherche');


            $articles = $articles = $em->getRepository('AppBundle:Medecin')->recherche($motcle);


        } else {
            //$articles=$em->getRepository('toonaShopBundle:Article')->findAll();
            $motcle=$request->get('recherche');

            $articles = $em->getRepository('AppBundle:Medecin')->recherche($motcle);


            //return $this->redirect($this->generateUrl('liste_medecin'));
            // $recherche=$request->get('ts_recherche_recherche');

            //$em = $this->getDoctrine()->getManager();
            //$articles = $em->getRepository('toonaShopBundle:Article')->findByNom($recherche);
            return $this->render('default/liste.html.twig', array('medecins' => $articles));
        }

        $items=array();
        foreach ($articles as $item){
            $items[]=array('id'=>$item->getId(),'nom'=>$item->getNom(),'photo'=>$item->getPhoto(),'postnom'=>$item->getPostnom(),'prenom'=>$item->getPrenom(),'hopital'=>$item->getHopital()->getNom(),'annee'=>$item->getAnnee());
        }

        $response = new JsonResponse();
        return $response->setData(array('items' => $items));
        //return $this->get('templating')->renderResponse('toonaShopBundle:Store:pos.html.twig', array('items' => $articles));
        //return new JsonResponse(array('items'=>$articles))->headers->set('Content-Type', 'application/json');;
        //return $this->redirect($this->generateUrl('ts_pos'));
    }

    /**
     * Lists all medecin entities.
     *
     */
    public function listeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medecins = $em->getRepository('AppBundle:Medecin')->findAll();

        return $this->render('default/liste.html.twig', array(
            'medecins' => $medecins,
        ));
    }
}
