<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     * @param HttpClientInterface $httpClient
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function index(HttpClientInterface $httpClient)
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
}
