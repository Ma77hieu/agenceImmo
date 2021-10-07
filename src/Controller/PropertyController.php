<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\SearchProperty;
use App\Form\PropertySearchType;
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

    public function index(PagerPaginatorInterface $paginator, Request $request): Response
    {
        $property=$this->repository->queryAllVisible();
        $pagination = $paginator->paginate(
            $property, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        

        return $this->render('property/property.html.twig',[
            'current_menu'=>"properties",
            'pagination'=>$pagination
        ]);
    }

    public function search(PagerPaginatorInterface $paginator,Request $request): Response
    {
        $search=new SearchProperty();
        $form=$this->createForm(PropertySearchType::class,$search);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid() || str_contains($request->getRequestUri(),'page='))
        {
            $properties=$this->repository->searchFromVisible($search);
            $pagination = $paginator->paginate(
                $properties, /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                6 /*limit per page*/
            );    
            return $this->render('property/results.html.twig',[
                'current_menu'=>"properties",
                'pagination'=>$pagination
            ]);
        }
        if(!str_contains($request->getRequestUri(),'page='))
        {
            return $this->render('property/search.html.twig', [
                'form'=>$form->createView()
            ]);
            
        }
    }

    public function show(Property $property): Response
    {
        return $this->render('property/show.html.twig',[
            'current_menu'=>"properties",
            'property'=>$property
        ]);
    }
}