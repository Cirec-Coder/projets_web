<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Repository\AdresseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdressesController extends AbstractController
{
    #[Route('/api/adresses', name: 'app_adresses', methods: ['GET'])]
    public function getAdresseList(AdresseRepository $adresseRepository, SerializerInterface $serializer): JsonResponse
    {

        if (isset($_GET['nom'])) {
            return $this->getDetailName($_GET['nom'], $serializer, $adresseRepository);
        }
        $adresseList = $adresseRepository->findAll();

        $jsonAdresseList = $serializer->serialize($adresseList, 'json');
        return new JsonResponse($jsonAdresseList, Response::HTTP_OK, [], true);
    }




    #[Route('/api/adresses/{id}', name: 'app_detailAdresses', methods: ['GET'])]
    public function getDetailAdresse(Adresse $adresse, SerializerInterface $serializer): JsonResponse
    {

        $jsonAdresse = $serializer->serialize($adresse, 'json');
        return new JsonResponse($jsonAdresse, Response::HTTP_OK, [], true);
    }


    #[Route('/api/adresses/nom/{nom}', name: 'app_detailName', methods: ['GET'], requirements: ['nom' => '.+'])]
    public function getDetailName($nom, SerializerInterface $serializer, AdresseRepository $adresseRepository): JsonResponse
    {
        $adresse = $adresseRepository->findByName($nom);
        if ($adresse) {
            $jsonAdresse = $serializer->serialize($adresse, 'json');
            return new JsonResponse($jsonAdresse, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}
