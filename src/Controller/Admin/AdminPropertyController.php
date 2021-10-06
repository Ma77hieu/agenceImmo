<?php
namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPropertyController extends AbstractController{

    public function __construct(PropertyRepository $repository,ManagerRegistry $em)
    {
        $this->repository=$repository;
        $this->em=$em->getManager();
    }

    public function index(PropertyRepository $repository): Response
    {
        $properties=$this->repository->findAll();
        return $this->render('property/adminlist.html.twig', [
            'properties'=> $properties,
            'current_menu'=>"properties"
        ]);
    }

    public function edit(Property $property,Request $request): Response
    {
        $form=$this->createForm(PropertyType::class,$property);
        dump($request);
        $form->handleRequest($request);
        dump($form);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success','Modification des caractéristiques du bien effectuée');
            return $this->redirectToRoute('admin.property.show');
        }
        return $this->render('property/edit.html.twig', [
            'property'=>$property,
            'form'=>$form->createView()
        ]);
    }

    public function create(Request $request): Response
    {
        $property= new Property();
        $form= $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success','Création de bien effectuée');
            return $this->redirectToRoute('admin.property.show');
        }
        return $this->render('property/new.html.twig', [
            'property'=>$property,
            'form'=>$form->createView()
        ]);
    }

    public function delete(Property $property): Response
    {
        $this->em->remove($property);
        $this->em->flush();
        $this->addFlash('success','Le bien a été supprimé');
        return $this->redirectToRoute('admin.property.show');
    }
}