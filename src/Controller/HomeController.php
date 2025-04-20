<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\JeuRepository;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
public function index(JeuRepository $jeuRepository): Response
{
    $jeuxRecents = $jeuRepository->findBy([], ['id' => 'DESC'], 5);

    return $this->render('home/index.html.twig', [
        'jeuxRecents' => $jeuxRecents,
    ]);
}
}
