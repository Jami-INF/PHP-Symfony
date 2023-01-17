<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    #[Route('/', name: 'app_hello_world')]
    public function home()
    {
        return $this->render('home.html.twig');
    }

    #[Route('/helloworld', name: 'app_hello_name')]
    public function hello() 
    {
        return $this->render('hello.html.twig', [
            'name' => 'John Doe',
        ]);
    }
}
