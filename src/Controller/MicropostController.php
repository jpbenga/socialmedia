<?php

namespace App\Controller;

use App\Entity\Micropost;
use App\Repository\MicropostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicropostController extends AbstractController
{
    #[Route('/micropost', name: 'app_micropost')]
    public function index(MicropostRepository $posts): Response
    {
        return $this->render('micropost/index.html.twig', [
            'posts' => $posts->findAll(),
        ]);
    }
    #[Route('/micropost/{post}', name: 'app_micropost_show')]
    public function show(Micropost $post): Response
    {
        return $this->render('micropost/show.html.twig', [
            'post' => $post,
        ]);
    }
}
