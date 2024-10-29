<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Comment;
use App\Repository\CommentRepository;

#[Route('/comment')]
class CommentController extends AbstractController
{
    #[Route('/list', name: 'app_comment_list')]
    public function list(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/list.html.twig', [
            'appName' => $_ENV["APP_NAME"],
            'comments' => $commentRepository->findAll()
        ]);
    }

    #[Route('/show/{id<\d+>}', name: 'app_comment_show')]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'appName' => $_ENV['APP_NAME'],
            'comment' => $comment,
        ]);
    }
}
