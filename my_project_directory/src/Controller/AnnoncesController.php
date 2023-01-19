<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\Form\AnnonceType;
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

        $annonce = new Annonce();

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);
        if($form->idSubmitted && $form->isValid()){
            $annonce = $form->getData();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('app_hello_world');
        }

        return $this->render('annonces/index.html.twig', [
            'controller_name' => 'AnnoncesController',
            'annonces' => $annonces,
            'form' => $form->createView(),
        ]);

    }
}
