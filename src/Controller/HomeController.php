<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
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
            'controller_name' => 'HomeController',
            'posts' => $posts,
            'postsHighlight' => $postsHighlight,
        ]);
    }

    #[Route('/post/{slug}', name: 'post_view')]
    public function post(Post $post): Response
    {
        return $this->render('post/index.html.twig', [
            'post' => $post
        ]);
    }
}
