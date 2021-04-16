<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Form\CategoriesType;


/**
 * @Route("/admin/products", name="admin_products_")
 * @package App\Controller\Admin
 */

class ProductsController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(ProductsRepository $productsRepo): Response
    {
        return $this->render('admin/products/index.html.twig', [
            'products' => $productsRepo->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function addProducts(Request $request): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUsers($this->getUser());


            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return($this->redirectToRoute('admin_products_home'));
        }
        return $this->render('admin/products/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editProduct(Products $product, Request $request ): Response
    {
        $form = $this->createForm(ProductsType::class, $product);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('admin_products_home');
        }
        return $this->render('admin/product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Products $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        $this->addFlash('message', 'Votre produit est supprimé');
        return $this->redirectToRoute('admin_products_home');
    }
}