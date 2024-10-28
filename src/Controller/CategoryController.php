<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/list', name: 'app_category_list')]
    public function list(): Response
    {
        return $this->render('category/list.html.twig', [
            'appName' => $_ENV["APP_NAME"]
        ]);
    }
}
