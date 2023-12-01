<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category/', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('{categoryName}', methods: 'GET', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneByName($categoryName);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category found in category\'s table.'
            );
        }

        $programs = $programRepository->findByCategory($category->getId(), ['id' => 'DESC'], 3, 0);

        return $this->render('category/show.html.twig', [
            'programs' => $programs,
            'category_name' => $categoryName,
        ]);
    }
}
