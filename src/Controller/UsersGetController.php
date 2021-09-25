<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersGetController extends AbstractController
{
    
    public function __invoke(): Response
    {
        var_dump("hey");
        return $this->render('users_get/index.html.twig', [
            'controller_name' => 'UsersGetController',
        ]);
    }
}
