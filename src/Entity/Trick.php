<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAte = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $upDating = null;

    #[ORM\Column(length: 50)]
    private ?string $author = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $authorUp = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getCreatedAte(): ?\DateTimeInterface
    {
        return $this->createdAte;
    }

    public function setCreatedAte(\DateTimeInterface $createdAte): self
    {
        $this->createdAte = $createdAte;

        return $this;
    }

    public function getUpDating(): ?\DateTimeInterface
    {
        return $this->upDating;
    }

    public function setUpDating(\DateTimeInterface $upDating): self
    {
        $this->upDating = $upDating;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthorUp(): ?string
    {
        return $this->authorUp;
    }

    public function setAuthorUp(?string $authorUp): self
    {
        $this->authorUp = $authorUp;

        return $this;
    }

    public function getCategory(): ?int
    {
        return $this->category;
    }

    public function setCategory(int $category): self
    {
        $this->category = $category;

        return $this;
    }
}
