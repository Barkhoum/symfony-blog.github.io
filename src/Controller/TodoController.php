<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //Afficher notre tableau de todo

        //sinon je l'initialise puis l'affiche
        if (!$session->has(name:'todos')){
            $todos =[
                'Achat' => 'Acheter un vélo',
                'Commande' =>  'Allez chercher un ecran pour pc',
                'Cours'=> 'Apprendre Synfony',
                'Correction' => 'Revoir PHP POO'
            ];
            $session ->set('todos', $todos);
            $this->addFlash(type:'info', message:"La liste des todos viens d'être initialisée");
        }

        //si j'ai mon tableau de todo dans ma session je ne fait que l'afficher
        return $this->render(view:'todo/index.html.twig');
    }
    #[Route('/todo/{name}/{content}', name:todo.add)]
    public function addTodo(Request $request, $name, $content){
        $session = $request->getSession();
        //Vérifier si j'ai mon tableau de todo dans la session
        if($session->has(name:'todos')){
            //si oui
            // Vérifier si on a déja un todo avec le meme name
            $todos =[$session->get(name:'todos')]
            if ($isset($todos[$name])){
                //si oui afficher le message d'erreur
                $this->addFlash(type:'error', message:"le todo d'id $name existe déja")
            }else{
                //Si non on l'ajoute et en affiche un message de succés
                $todos[$name] = $content;
                $this->addFlash(type:'succes', message:"le todo d'id $name à été ajouté avec succès")
            }
        }else{
        //si non
        //affiche une erreur et on va rediriger vers le controlleur index
        $this->addFlash(type:'error', message:"La liste des todos n'est pas encore initialiséé")
        }
        return $this->redirectToRoute(route:'todo');
    }
}