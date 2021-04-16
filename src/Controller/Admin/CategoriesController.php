<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Form\CategoriesType;


/**
 * @Route("/admin/categories", name="admin_categories_")
 * @package App\Controller\Admin
 */

class CategoriesController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(CategoriesRepository $categoriesRepo): Response
    {
        return $this->render('admin/categories/index.html.twig', [
            'categories' => $categoriesRepo->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function addCategories(Request $request): Response
    {
        $categorie = new Categories;
        $form = $this->createForm(CategoriesType::class, $categorie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categories_home');
        }
        return $this->render('admin/categories/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editCategories(Categories $categorie, Request $request ): Response
    {
        $form = $this->createForm(CategoriesType::class, $categorie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categories_home');
        }
        return $this->render('admin/categories/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}