<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'first')]//route c'est antislash puis le nom que l'on souhaite afficher puis le name correspont à l'ID de la class!
    public function index(): Response
    {
        //chercher au niveau de la base de données vos users
        return $this->render('first/index.html.twig',[
        'name' => 'Dupont',
        'firstname' => 'Marie'

        ]);
    }

    #[Route('/sayHello/{name}/{firstname}', name:'say.hello')]
    public function sayHello(Request $request, $name, $firstname): Response
    {
        dd($request);
       return $this->render(view: 'first/hello.html.twig', parameters: [
           'nom' => $name,
           'prenom' => $firstname
        ]);

    }
}
