<?php

namespace App\Twig;

use App\Repository\CategoryRepository;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(Environment $twig, CategoryRepository $categoryRepository)
    {
        $this->twig               = $twig;
        $this->categoryRepository = $categoryRepository;
    }


    public function getFunctions()
    {
        return [
            new TwigFunction('my_menu', [$this, 'menu'], ['is_safe' => ['html']]),
        ];
    }

    public function menu()
    {
        $categories = $this->categoryRepository->findAll();
        return $this->twig->render('_partials/_menu.html.twig', [
            'categories' => $categories,
        ]);
    }
}