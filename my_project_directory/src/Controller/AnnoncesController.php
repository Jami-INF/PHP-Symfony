<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use Doctrine\ORM\EntityManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;

class AnnoncesController extends AbstractController
{
    #[Route('/annonces', name: 'app_annonces')]
    public function listAnnonce(ManagerRegistry $doctrine): Response
    {
        $annonces = $doctrine->getRepository(Annonce::class)->listAnnonce();//listAnnonce() est une méthode que j'ai créé dans AnnonceRepository.php

        return $this->render('annonces/index.html.twig', [
            'controller_name' => 'AnnoncesController',
            'annonces' => $annonces
        ]);
    }
}
