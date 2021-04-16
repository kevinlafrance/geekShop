<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/products", name="products_")
 */

class ProductsController extends AbstractController
{
    
    /**
     * @Route("/details/{slug}", name="details")
     */
    public function productDetails($slug, ProductsRepository $productsRepo): Response
    {
        $product = $productsRepo->findOneBy(['slug' => $slug]);

        if(!$product) {
            throw new NotFoundHttpException("Pas de produit");
        }

        return $this->render('products/details.html.twig',
            compact('product'));
    }
}
