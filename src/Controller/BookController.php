<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }
    /* 
    #[Route('/addbook', name: "add_book")]
    public function addBook(ManagerRegistry $m, Request $req)
    {
        $newbook = new Book();
        $em = $m->getManager();
        $form = $this->createForm(BookType::class, $newbook);
        //$newbook->setPublished(true);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $author = $newbook->getRefbook(); // Corrected method name
            if ($author !== null) {
                $idr = $author->getIdR(); // Assuming idR is a property of Author, adjust this based on your entity structure.            
                $em->persist($newbook);
                $em->flush();
            } 
        }
        return $this->renderForm("book/add.html.twig", ["form" => $form]);
    }

 */
#[Route('/add', name: "add_book")]
    public function addBook(ManagerRegistry $doctrine, Request  $req)
    {
        $em = $doctrine->getManager();
        $Book = new Book();

        $form  = $this->createForm(BookType::class, $Book);

        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em->persist($Book);
            $em->flush();

            return $this->redirectToRoute('list_book');
        }
        
        return $this->renderForm("book/add.html.twig", ['form' => $form]);
    }
    #[Route('/update/{id}', name: "update_book")]
    public function updateBook($id, BookRepository $repo, ManagerRegistry $m, Request $req)
    {
        $book = $repo->find($id);
        $em = $m->getManager();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {

            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute("list_book");
        }
        return $this->renderForm("book/update.html.twig", ["f" => $form]);
    }


    #[Route('/listBooks', name: "list_book")]
    public function listBooks(BookRepository $repo){
    
        return $this->render("book/list.html.twig",  ["books" => $repo->findAll()]);
    }




    #[Route('/delete/{id}', name: "delete")]

    public function delete($id, BookRepository $repo, ManagerRegistry $m)
    {


        $em = $m->getManager();

        $book = $repo->find($id);


        $em->remove($book);

        $em->flush();

        return $this->redirectToRoute("list_book");
    }
}

