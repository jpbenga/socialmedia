<?php

namespace App\Controller;

use App\Entity\Micropost;
use App\Form\MicroPostType;
use App\Repository\MicropostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/micropost/add', name: 'app_micropost_add', priority: 2)]
    public function add(Request $request, MicropostRepository $posts): Response
    {
        $form = $this->createForm(MicroPostType::class, new Micropost);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $post->setDateTime(new DateTime());
            $posts->save($post, true);

            $this->addFlash('success', 'Your micropost has been added succesfully');

            return $this->redirectToRoute('app_micropost');
        }

        return $this->renderForm('micropost/add.html.twig', [
            'form' => $form
        ]);    
    }

    #[Route('/micropost/{post}/edit', name: 'app_micropost_edit')]
    public function edit(Micropost $post, Request $request, MicropostRepository $posts): Response
    {
        
        $form = $this->createForm(MicroPostType::class, $post);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $posts->save($post, true);

            $this->addFlash('success', 'Your micropost has been updated succesfully');

            return $this->redirectToRoute('app_micropost');
        }

        return $this->renderForm('micropost/edit.html.twig', [
            'form' => $form
        ]);    
    }
}
