<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{

    private $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' =>
        'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg', 'username' => ' William Shakespeare', 'email' =>
        ' william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' =>
        'taha.hussein@gmail.com', 'nb_books' => 300),
    );

    #[Route('/list', name: 'author_list')]
    public function list(): Response
    {
        return $this->render('author/list.html.twig', [
            'authors' => $this->authors,
        ]);
    }
    #[Route('/author/{name}', name: 'author_show')]
    public function showAuthor($name): Response
    {
        return $this->render('author/show.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/getAll', name: 'author_listDB')]
    public function getAll(AuthorRepository $repo): Response
    {
        /* Select * from author */
        $list = $repo->findAll();
        return $this->render('author/listDB.html.twig', [
            'authors' => $list
        ]);
    }

    #[Route('/getOne/{id}', name: 'author_OneDB')]
    public function getOne(AuthorRepository $repo, $id): Response
    {
        /* Select * from author where id=$id */
        $author = $repo->find($id);
        return $this->render('author/detailsDB.html.twig', [
            'author' => $author
        ]);
    }
}
