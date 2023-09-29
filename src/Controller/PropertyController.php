<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    #[Route('/property/create', name: 'app_property_create')]
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $property = new Property();
        $property->setProfile($this->getUser()->getProfile());
        $propertyForm = $this->createForm(PropertyType::class, $property);
        $propertyForm->handleRequest($request);
        if ($propertyForm->isSubmitted() && $propertyForm->isValid()) {
            $manager->persist($property);
            $manager->flush();
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('property/create.html.twig', [
            'propertyForm'=>$propertyForm
        ]);
    }
}
