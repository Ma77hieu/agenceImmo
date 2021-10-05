<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListProperties extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct($twig,PropertyRepository $repository,ManagerRegistry $em)
    {
        $this->repository=$repository;
        $this->em=$em->getManager();
    }
    public function index(): Response
    {
        // $property= new Property();
        // $property->setTitle('Premier bien')
        //     ->setPrice(200000) 
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setDescription('une descirption standard')
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity('Montpellier')
        //     ->setAddress('15 boulevard Gambetta')
        //     ->setPostalCode('34000');
        // $em=$this->getDoctrine()->getManager();
        // $em->persist($property);
        // $em->flush();
        // $property=$this->repository->findAllVisible();
        // $property[0]->setSold(true);
        // dump($property);
        // $this->em->flush();
        return $this->render('property/property.html.twig',[
            'current_menu'=>"properties"
        ]);
    }
}