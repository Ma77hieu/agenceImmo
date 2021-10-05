<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct($twig,PropertyRepository $repository)
    {
        $this->repository=$repository;
    }
    public function index(): Response
    {
        
        $properties=$this->repository->findLatest();
        dump($properties);
        return $this->render('pages/home.html.twig',[
            'current_menu'=>"home",
            'properties'=>$properties
        ]);
    }
    
}
