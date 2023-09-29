<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/image/addtoprofile', name: 'app_image_profile_add')]
    public function addImage(Request $request, EntityManagerInterface $manager): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldImage = $this->getUser()->getProfile()->getImage();
            if ($oldImage){
                $manager->remove($oldImage);
            }
            $image->setProfile($this->getUser()->getProfile());
            $manager->persist($image);
            $manager->flush();
        }
        return $this->redirectToRoute('app_profile');
    }
}
