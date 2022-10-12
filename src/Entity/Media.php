<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column]
    private ?bool $type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAte = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[ORM\JoinColumn(nullable: true)]
    private ?trick $trickRelation = null;

    #[ORM\ManyToOne(inversedBy: 'MediaRelation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $CreatedUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function isType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

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

    public function getTrickRelation(): ?trick
    {
        return $this->trickRelation;
    }

    public function setTrickRelation(?trick $trickRelation): self
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
