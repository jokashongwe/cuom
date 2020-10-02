<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Medecin;
use Doctrine\Common\Collections\ArrayCollection;
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

    private function getMedecinFromQualificationArray($qualifications){
        $medecins = new  ArrayCollection();
        foreach ($qualifications as $qualification)
        {
            $medecins->add($qualification->getMedecin());
        }
        return $medecins->toArray();
    }

    private function contains($array, $element)
    {
        foreach ($array as $item)
        {
            if($item->getId() == $element->getId()) return true;
        }
        return false;
    }


    private function uniqueArray($array)
    {
        $items = array();
        foreach ($array as $item)
        {
            if($this->contains($items, $item)) continue;
            $items = array_merge($items, [$item]);
        }
        return $items;
    }

    public function rechercheTraitementAction(Request $request)
    {
        //$form = $this->createForm(new RechercheType());
       try{
           $em = $this->getDoctrine()->getManager();

           $content = json_decode($request->getContent(), true);

           $contentData = json_decode($content['recherche']);
           $result = array();
           $dbResult = array();
           foreach ($contentData as $item)
           {
               if($item->value == "") continue;
               $name = strtolower($item->name);
               if($name == "universite" or $name == "specialite")
               {
                   $obj = $em->getRepository('AppBundle:'. ucfirst($item->name))->find($item->value);
                   if($obj !== null){
                       $dbResult = array_merge($dbResult, $this->getMedecinFromQualificationArray($obj->getQualifications()));
                   }
               } else if($name == "hopital" or $name == "statut") {
                   $obj = $em->getRepository(Medecin::class)->recherchePar($item);

                   if($obj !== null){
                       $dbResult = array_merge($dbResult, $obj);
                   }
               } else if($name == "nom") {
                   $medecins = $em->getRepository(Medecin::class)->recherche($item->value);
                   $dbResult = array_merge($dbResult, $medecins);
               }

               if(count($result) == 0 && count($dbResult) !== 0) {
                   $result = array_merge($result, $dbResult);
               } else{
                   if(count($dbResult) !== 0) {
                       $result = array_uintersect($dbResult, $result, function($a, $b) {
                           return $a !== $b;
                       });
                   }
               }
           }
           $response = new JsonResponse();
           return $response->setData($this->parseMedecin($this->uniqueArray($result)));
       } catch (\Exception $e) {
           $response = new JsonResponse();
           die(var_dump($e->getMessage()));
           return $response->setData([]);
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
        $iter = 0;

        foreach ($data as $item){
            $items[]=array('id'=>$item->getId(),'nom'=>$item->getNom(),'photo'=>$item->getPhoto(),
                'postnom'=>$item->getPostnom(),'prenom'=>$item->getPrenom(),
                'hopital'=>$item->getHopital()->getNom(),
                'email' => $item->getEmail(),
                'statut' => $item->getStatut()->getNom(),
                'universite' => $this->parseQual($item->getQualifications(), 'universite'),
                'telephone' => $item->getTelephone(),
                'specialite'=>$this->parseQual($item->getQualifications()));
            $iter++;
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
