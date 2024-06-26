<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/{id}/rooms', name: 'app_rooms')]
    public function index(Property $property): Response
    {
        return $this->render('room/index.html.twig', [
            'property' => $property
        ]);
    }

    #[Route('{id}/rooms/create', name: 'app_room_create', priority: 2)]
    #[Route('{id}/rooms/edit/{roomId}', name: 'app_room_edit', priority: 2)]
    public function create(Request $request, EntityManagerInterface $manager,Property $property, Room $room = null): Response
    {
        $edit = false;
        if ($room){
            $edit = true;
        }
        if (!$edit){
            $room = new Room();
            $room->setProperty($property);
        }
        $roomForm = $this->createForm(RoomType::class, $room);
        $roomForm->handleRequest($request);
        if ($roomForm->isSubmitted() && $roomForm->isValid())
        {
            $manager->persist($room);
            $manager->flush();
            return $this->redirectToRoute('app_rooms', [
                'id'=>$property->getId()
            ]);
        }

        return $this->render('room/create.html.twig', [
            'property'=>$property,
            'roomForm'=>$roomForm,
            'edit'=>$edit
        ]);
    }

    #[Route('/room/{id}', name: 'app_room_show')]
    public function show(Room $room): Response
    {

        return $this->render('room/show.html.twig', [
            'room' => $room
        ]);
    }

    #[Route('/rooms/delete/{id}', name: 'app_room_delete', priority: 2)]
    public function delete(EntityManagerInterface $manager, Room $room, RoomRepository $roomRepository): Response
    {
        $propiD = $room->getProperty()->getId();


        $query = $roomRepository
            ->createQueryBuilder('du')
            ->delete('App:Room','du')
            ->where('du.id = :id')
            ->setParameter("id", $room->getId())
            ->getQuery()
            ->execute();

        return $this->redirectToRoute('app_rooms', [
            'id'=>$propiD
        ]);
    }
}
