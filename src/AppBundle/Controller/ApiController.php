<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
    public function getSpecialiteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $specialite = $em->getRepository('AppBundle:Specialite')->findAll();
        $jsonData = $this->arraySpecToJson($specialite);
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public function getSpecialiteByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $specialites = $em->getRepository('AppBundle:Specialite')->find($id);
        $jsonData = $this->arraySpecToJson([$specialites]);
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public function getUniversiteByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $univ = $em->getRepository('AppBundle:Universite')->find($id);
        $jsonData = $this->arrayUnivToJson([$univ]);
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public function getUniversiteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $univ = $em->getRepository('AppBundle:Universite')->findAll();
        $jsonData = $this->arrayUnivToJson($univ);
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public function getStatutByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $univ = $em->getRepository('AppBundle:Statut')->find($id);
        $jsonData = $this->arrayStatutToJson([$univ]);
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public function getStatutAction()
    {
        $em = $this->getDoctrine()->getManager();
        $univ = $em->getRepository('AppBundle:Statut')->findAll();
        $jsonData = $this->arrayStatutToJson($univ);
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public function getMedecinByIdAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $univ = $em->getRepository('AppBundle:Medecin')->find($id);
        $jsonData = $this->arrayMedecinToJson([$univ], $request->getHttpHost());
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public function  getHopitalByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $univ = $em->getRepository('AppBundle:Hopital')->find($id);
        $jsonData = $this->arrayHopitalToJson([$univ]);
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public  function rechercheMedecinAction(Request $request, $mot)
    {
        $em = $this->getDoctrine()->getManager();
        $medecins = $em->getRepository('AppBundle:Medecin')->recherche($mot);
        $jsonData = $this->arrayMedecinToJson($medecins, $request->getHttpHost());
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    public  function rechercheMedecinBySpecialiteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = (object) array('name' => 'specialite', 'value' => $id);
        $medecins = $em->getRepository('AppBundle:Medecin')->rechercheParSpecialite($item);
        $jsonData = $this->arrayMedecinToJson($medecins, $request->getHttpHost());
        $json = new JsonResponse();
        return $json->setData([
            'status' => 200,
            'data' => $jsonData
        ]);
    }

    // helper part

    private function arraySpecToJson($array)
    {
        $items = array();
        foreach ($array as $item) {
            $items[] = array(
                'id' => $item->getId(),
                'nom' => $item->getSpecialite(),
                'nbr' => $item->getNombreMedecin()
            );
        }
        return $items;
    }
    private function arrayUnivToJson($array)
    {
        $items = array();
        foreach ($array as $item) {
            $items[] = array(
                'id' => $item->getId(),
                'nom' => $item->getNom(),
                'adresse' => $item->getAdresse(),
            );
        }
        return $items;
    }
    private function arrayStatutToJson($array)
    {
        $items = array();
        foreach ($array as $item) {
            $items[] = array(
                'id' => $item->getId(),
                'nom' => $item->getNom(),
            );
        }
        return $items;
    }
    private function arrayMedecinToJson($array, $uri)
    {
        $items = array();
        foreach ($array as $item) {
            $items[] = array(
                'id' => $item->getId(),
                'cnom' => $item->getCnom(),
                'nom' => $item->getNom(),
                'postnom' => $item->getPostnom(),
                'prenom' => $item->getPrenom(),
                'image' => $uri . '/uploads/photos_medecins/' . $item->getPhoto(),
                'phone' => $item->getTelephone(),
                'anneeDiplome' => $item->getLastQualification()->getAnnee(),
                'email' => $item->getEmail(),
                'institution' => 'http://'.$uri .'/api/hopitals/' . $item->getHopital()->getId(),
            );
        }
        return $items;
    }
    private function arrayHopitalToJson($array)
    {
        $items = array();
        foreach ($array as $item) {
            $items[] = array(
                'id' => $item->getId(),
                'nom' => $item->getNom(),
                'adresse' => $item->getAdresse()
            );
        }
        return $items;
    }
}