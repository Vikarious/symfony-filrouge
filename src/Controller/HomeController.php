<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\CommentType;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findPostsActive();
        $postsHighlight = $postRepository->findPostsHighlight();

        return $this->render('home/index.html.twig', [
            'posts' => $posts,
            'postsHighlight' => $postsHighlight,
        ]);
    }

    #[Route('/post/{slug}', name: 'post_view')]
    public function post(Post $post, Request $request, ManagerRegistry $doctrine): Response
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPost($post);
            $comment->setUser($this->getUser());    
            $em = $doctrine->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('post_view', array('slug' => $post->getSlug()));
        }

        return $this->renderForm('post/index.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/category/{slug}', name: 'post_category')]
    public function category(Category $category, CategoryRepository $categoryRepository): Response
    {
        $posts = $categoryRepository->findPostByCategory($category);

        return $this->render('home/category.html.twig', [
            'posts' => $posts,
            'category'=>$category->getName(),
        ]);
    }
}
