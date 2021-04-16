<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductsRepository $productsRepo, CategoriesRepository $categoriesRepo ): Response
    {
        return $this->render('main/index.html.twig', [
            'products' => $productsRepo->findAll(),
            'categories' => $categoriesRepo->findAll(),
        ]);
    }

     /**
     * @Route("/mentions-legales", name="mentions")
     */
    public function mentions(): Response
    {
        return $this->render('main/mentions.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faq(): Response
    {
        return $this->render('main/faq.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}
