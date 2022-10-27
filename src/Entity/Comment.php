<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length([
        'min' => 2,
        'max' => 100,
        'minMessage' => 'Votre commentaire doit contenir plus de 2 caractéres',
        'maxMessage' => 'Votre commentaire doit contenir moins de 100 caractéres',
    ])]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAte = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Trick $trickRelation = null;

    #[ORM\ManyToOne(inversedBy: 'CommentRelation')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $CreatedUser = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTrickRelation(): ?Trick
    {
        return $this->trickRelation;
    }

    public function setTrickRelation(?Trick $trickRelation): self
    {
        $this->trickRelation = $trickRelation;

        return $this;
    }

    public function getCreatedUser(): ?User
    {
        return $this->CreatedUser;
    }

    public function setCreatedUser(?User $CreatedUser): self
    {
        $this->CreatedUser = $CreatedUser;

        return $this;
    }
}
