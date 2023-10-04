<?php

namespace App\Controller;

use App\Entity\PropertyCategory;
use App\Form\PropertyCategoryType;
use App\Repository\PropertyCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyCategoryController extends AbstractController
{
    #[Route('/admin/propertycat', name: 'app_propertycat')]
    public function index(PropertyCategoryRepository $propertyCategoryRepository): Response
    {
        return $this->render('property_category/index.html.twig', [
            'categories' => $propertyCategoryRepository->findAll()
        ]);
    }

    #[Route('/admin/propertycat/create', name: 'app_propertycat_create', priority: 2)]
    #[Route('/admin/propertycat/edit/{id}', name: 'app_propertycat_edit', priority: 2)]
    public function create(Request $request, EntityManagerInterface $manager, PropertyCategory $category = null): Response
    {
        $edit = false;
        if ($category){
            $edit = true;
        }
        if (!$edit){
            $category = new PropertyCategory();
        }
        $categoryForm = $this->createForm(PropertyCategoryType::class, $category);
        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid())
        {
            $manager->persist($category);
            $manager->flush();
            return $this->redirectToRoute('app_propertycat');
        }

        return $this->render('property_category/create.html.twig', [
            'categoryForm'=>$categoryForm,
            'edit'=>$edit
        ]);
    }

    #[Route('/admin/propertycat/delete/{id}', name: 'app_propertycat_delete', priority: 2)]
    public function delete(PropertyCategory $category, EntityManagerInterface $manager): Response
    {
        $manager->remove($category);
        $manager->flush();
        return $this->redirectToRoute('app_propertycat');
    }
}
