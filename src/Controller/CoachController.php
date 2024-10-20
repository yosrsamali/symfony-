<?php

// src/Controller/CoachController.php

// src/Controller/CoachController.php

namespace App\Controller;

use App\Entity\Coach;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoachController extends AbstractController
{
    #[Route('/add-coach', name: 'add_coach', methods: ['POST'])]
    public function addCoach(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cin = $request->request->get('cin');
        $specialite = $request->request->get('specialite');
        $dateInscription = new \DateTime(); // Par exemple, date actuelle

        // Vérifiez si le coach existe déjà
        $existingCoach = $entityManager->getRepository(Coach::class)->findOneBy(['cin' => $cin]);

        if ($existingCoach) {
            return new Response('Coach already exists.', Response::HTTP_BAD_REQUEST);
        }

        // Ajoutez le coach
        $coach = new Coach();
        $coach->setCin($cin);
        $coach->setSpecialite($specialite);
        $coach->setDateInscription($dateInscription);

        $entityManager->persist($coach);
        $entityManager->flush();

        return new Response('Coach added successfully!', Response::HTTP_OK);
    }

    #[Route('/delete-coach/{id}', name: 'delete_coach', methods: ['DELETE'])]
    public function deleteCoach(int $id, EntityManagerInterface $entityManager): Response
    {
        // Récupérer le coach à partir de l'ID
        $coach = $entityManager->getRepository(Coach::class)->find($id);

        if (!$coach) {
            // Si le coach n'existe pas, retourner une réponse 404
            return new Response('Coach does not exist.', Response::HTTP_NOT_FOUND);
        }

        // Supprimer le coach
        $entityManager->remove($coach);
        $entityManager->flush();

        return new Response('Coach deleted successfully!', Response::HTTP_OK);
    }
}
