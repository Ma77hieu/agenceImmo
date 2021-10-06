<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface as PagerPaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ListProperties extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct($twig,PropertyRepository $repository,EntityManagerInterface $em)
    {
        $this->repository=$repository;
        $this->em=$em;
    }
    // public function index(): Response
    // {
    //     // $property= new Property();
    //     // $property->setTitle('Premier bien')
    //     //     ->setPrice(200000) 
    //     //     ->setRooms(4)
    //     //     ->setBedrooms(3)
    //     //     ->setDescription('une descirption standard')
    //     //     ->setSurface(60)
    //     //     ->setFloor(4)
    //     //     ->setHeat(1)
    //     //     ->setCity('Montpellier')
    //     //     ->setAddress('15 boulevard Gambetta')
    //     //     ->setPostalCode('34000');
    //     // $em=$this->getDoctrine()->getManager();
    //     // $em->persist($property);
    //     // $em->flush();
    //     $property=$this->repository->findAllVisible();
    //     // $property[0]->setSold(true);
    //     // dump($property);
    //     // $this->em->flush();
    //     return $this->render('property/property.html.twig',[
    //         'current_menu'=>"properties",
    //         'properties'=>$property
    //     ]);
    // }

    public function index(PagerPaginatorInterface $paginator, Request $request): Response
    {
        // $property= new Property();

        $property=$this->repository->queryAllVisible();
        $pagination = $paginator->paginate(
            $property, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        

        return $this->render('property/property.html.twig',[
            'current_menu'=>"properties",
            'properties'=>$property,
            'pagination'=>$pagination
        ]);
    }

    public function show(Property $property): Response
    {
        return $this->render('property/show.html.twig',[
            'current_menu'=>"properties",
            'property'=>$property
        ]);
    }
}