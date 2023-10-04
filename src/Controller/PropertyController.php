<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    #[Route('/property', name: 'app_property')]
    public function index(PropertyRepository $propertyRepository): Response
    {
        return $this->render('property/index.html.twig', [
            'properties' => $propertyRepository->findAll()
        ]);
    }
    #[Route('/myproperties', name: 'app_myproperties')]
    public function myProperties(): Response
    {
        $myProperties = $this->getUser()->getProfile()->getProperties();
        return $this->render('property/myproperties.html.twig', [
            'myproperties' => $myProperties
        ]);
    }

    #[Route('/property/create', name: 'app_property_create', priority: 2)]
    #[Route('/property/edit/{id}', name: 'app_property_edit', priority: 2)]
    public function create(Request $request, EntityManagerInterface $manager, Property $property=null): Response
    {
        $edit = false;
        if ($property){
            $edit = true;
        }
        if (!$edit){
            $property = new Property();
            $property->setProfile($this->getUser()->getProfile());
        }
        $propertyForm = $this->createForm(PropertyType::class, $property);
        $propertyForm->handleRequest($request);
        if ($propertyForm->isSubmitted() && $propertyForm->isValid()) {
            $manager->persist($property);
            $manager->flush();
            foreach ($property->getEquipments() as $equipment){
                $equipment->addProperty($property);
                $manager->persist($equipment);
            }
            $manager->flush();
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('property/create.html.twig', [
            'propertyForm'=>$propertyForm,
            'edit'=>$edit
        ]);
    }

    #[Route('/property/delete/{id}', name: 'app_property_delete', priority: 2)]
    public function delete(Property $property, EntityManagerInterface $manager): Response
    {
        $manager->remove($property);
        $manager->flush();
        return $this->redirectToRoute('app_profile');
    }
}
