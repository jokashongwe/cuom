<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Medecin;
use AppBundle\Entity\Qualification;
use AppBundle\Entity\Specialite;
use AppBundle\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

        $em = $this->getDoctrine()->getManager();
        $universites = $em->getRepository('AppBundle:Universite')->findAll();
        $hopitaux = $em->getRepository('AppBundle:Hopital')->findAll();
        $specialites = $em->getRepository('AppBundle:Specialite')->findAll();
        $communes = $em->getRepository('AppBundle:Commune')->findAll();
        $statuts = $em->getRepository('AppBundle:Statut')->findAll();
        // replace this example code with whatever you need
        return $this->render('default/search.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'universites' => $universites, 'hopitaux' => $hopitaux, 'specialites' => $specialites, 'communes' => $communes, 'statuts' => $statuts]);
    }

    public function rechercheTraitementAction(Request $request)
    {
        //$form = $this->createForm(new RechercheType());
       try{
           $em = $this->getDoctrine()->getManager();

           $content = json_decode($request->getContent(), true);

           $contentData = json_decode($content['recherche']);
           $result = array();
           foreach ($contentData as $item)
           {
               $dbResult = $em->getRepository(Medecin::class)->rechercheAvecQualification($item->value);
               if(count($result) == 0) {
                   $result = array_merge($result, $dbResult);
               } else {
                   $result = array_uintersect($dbResult, $result, function($a, $b) {
                       return $a == $b;
                   });
               }
           }
           $response = new JsonResponse();
           return $response->setData($this->parseMedecin(array_unique($result, SORT_REGULAR)));
       } catch (\Exception $e) {
           $response = new JsonResponse();
           return $response->setData($e->getMessage());
       }
    }

    /**
     * @param ArrayCollection $data
     */
    public function parseQual($data, $type=null) {
        $result  = "";
        foreach ($data as $item)
        {
            if($type !== null and $type ='universite')
            {
                $result .= " " . $item->getUniversite()->getNom();
            } else
            {
                $result .= " " . $item->getSpecialite()->getSpecialite();
            }

        }
        return $result;
    }

    /**
     * @param Medecin[] $data
     * @return array
     */
    public function parseMedecin($data) {
        $items = array();
        foreach ($data as $item){
            $items[]=array('id'=>$item->getId(),'nom'=>$item->getNom(),'photo'=>$item->getPhoto(),
                'postnom'=>$item->getPostnom(),'prenom'=>$item->getPrenom(),
                'hopital'=>$item->getHopital()->getNom(),
                'email' => $item->getEmail(),
                'statut' => $item->getStatut()->getNom(),
                'universite' => $this->parseQual($item->getQualifications(), 'universite'),
                'telephone' => $item->getTelephone(),
                'specialite'=>$this->parseQual($item->getQualifications()));
        }
        return $items;
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
