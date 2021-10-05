<?php
namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminPropertyController extends AbstractController{

    public function __construct(PropertyRepository $repository)
    {
        $this->repository=$repository;
    }

    public function index(PropertyRepository $repository): Response
    {
        $properties=$this->repository->findAll();
        return $this->render('property/adminlist.html.twig', [
            'properties'=> $properties,
            'current_menu'=>"properties"
        ]);
    }

    public function edit(Property $property): Response
    {
        $form=$this->createForm(PropertyType::class,$property);
        return $this->render('property/edit.html.twig', [
            'property'=>$property,
            'form'=>$form->createView()
        ]);
    }
}