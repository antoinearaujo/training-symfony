<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="app_post")
     * @param HttpClientInterface $httpClient
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function index(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        $statusCode = $response->getStatusCode();

        if (Response::HTTP_OK !== (int)$statusCode) {
            $content = [];
        } else {
            $content = $response->getContent();
            $content = $response->toArray();
        }

        return $this->render('post/index.html.twig', [
            'posts' => $content,
        ]);
    }

    /**
     * @Route("/post/show/{id}", name="app_post_show")
     * @param int $id
     * @param HttpClientInterface $httpClient
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function show(int $id, HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'https://jsonplaceholder.typicode.com/posts/' . $id);
        $statusCode = $response->getStatusCode();

        if (Response::HTTP_OK !== (int)$statusCode) {
            $content = [];
        } else {
            $content = $response->getContent();
            $content = $response->toArray();
        }

        return $this->render('post/show.html.twig', [
            'post' => $content,
        ]);
    }
}
