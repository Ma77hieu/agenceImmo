<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListProperties extends AbstractController
{
    public function __construct($twig)
    {
        
    }
    public function index(): Response
    {
        return $this->render('property/property.html.twig',[
            'current_menu'=>"properties"
        ]);
    }
}