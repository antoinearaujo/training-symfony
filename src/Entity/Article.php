<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles", fetch="EAGER")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
     }

    /**
     * @Assert\Callback()
     * @param $object
     * @param ExecutionContextInterface $context
     * @param $payload
     */
    public static function validate($object, ExecutionContextInterface $context, $payload)
    {
        /** @var $object Article */
        if ($object->getTitle() !== 'toto') {
            $context->buildViolation('This name sounds totally fake!')
                ->atPath('content')
                ->addViolation()
            ;
        }
    }

    /**
     * @return bool
     */
    public function getEnabled(): bool
    {
        return true;
    }
}
