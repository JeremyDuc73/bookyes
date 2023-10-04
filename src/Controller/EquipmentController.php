<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipmentController extends AbstractController
{
    #[Route('/admin/equipment', name: 'app_equipment')]
    public function index(EquipmentRepository $equipmentRepository): Response
    {
        return $this->render('equipment/index.html.twig', [
            'equipments' => $equipmentRepository->findAll()
        ]);
    }

    #[Route('/admin/equipment/create', name: 'app_equipment_create', priority: 2)]
    #[Route('/admin/equipment/edit/{id}', name: 'app_equipment_edit', priority: 2)]
    public function create(Request $request, EntityManagerInterface $manager, Equipment $equipment = null): Response
    {
        $edit = false;
        if ($equipment){
            $edit = true;
        }
        if (!$edit){
            $equipment = new Equipment();
        }
        $equipmentForm = $this->createForm(EquipmentType::class, $equipment);
        $equipmentForm->handleRequest($request);
        if ($equipmentForm->isSubmitted() && $equipmentForm->isValid())
        {
            $manager->persist($equipment);
            $manager->flush();
            return $this->redirectToRoute('app_equipment');
        }

        return $this->render('equipment/create.html.twig', [
            'equipmentForm'=>$equipmentForm,
            'edit'=>$edit
        ]);
    }

    #[Route('/admin/equipment/delete/{id}', name: 'app_equipment_delete', priority: 2)]
    public function delete(Equipment $equipment, EntityManagerInterface $manager): Response
    {
        $manager->remove($equipment);
        $manager->flush();
        return $this->redirectToRoute('app_equipment');
    }
}
