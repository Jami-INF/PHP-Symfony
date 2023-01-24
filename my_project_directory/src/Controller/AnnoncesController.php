<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\form\AnnonceType;
use Doctrine\ORM\EntityManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class AnnoncesController extends AbstractController
{
    #[Route('/annonces', name: 'app_annonces')]
    public function listAnnonce(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $repo = $em->getRepository(Annonce::class);
        $annonces = $repo->listAnnonce();//listAnnonce() est une méthode que j'ai créé dans AnnonceRepository.php

        return $this->render('annonces/index.html.twig', [
            'annonces' => $annonces,
        ]);

    }

    #[Route('/annonces/{id}', name: 'app_annonce')]
    public function annonceInfo($id, ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $repo = $em->getRepository(Annonce::class);
        $annonce = $repo->find($id);

        return $this->render('annonces/info.html.twig', [
            'annonce' => $annonce,
        ]);

    }

    #[Route('/annonces/add', name: 'app_add_annonces')]
    public function addAnnonce(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $repo = $em->getRepository(Annonce::class);
        $annonces = $repo->listAnnonce();//listAnnonce() est une méthode que j'ai créé dans AnnonceRepository.php

        $annonce = new Annonce();

        $form = $this->createForm(AnnonceType::class, $annonce);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $annonce = $form->getData();
            $annonce->setDateCreation(new \DateTime());

            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('app_annonces');
        }

        return $this->render('annonces/add.html.twig', [
            'annonces' => $annonces,
            'form' => $form->createView(),
        ]);

    }
}
