<?php
//https://symfony.com/doc/current/validation.html
namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length([
        'min' => 2,
        'max' => 50,
        'minMessage' => 'Le nom de votre figure doit contenir plus de 2 caractéres',
        'maxMessage' => 'Le nom de votre figure doit contenir moins de 50 caractéres',
    ])]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length([
        'min' => 2,
        'max' => 1000,
        'minMessage' => 'Le nom de votre figure doit contenir plus de 2 caractéres',
        'maxMessage' => 'Le nom de votre figure doit contenir moins de 1000 caractéres',
    ])]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAte = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $upDating = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $category = null;

    #[ORM\OneToMany(mappedBy: 'trickRelation', targetEntity: Media::class, cascade: ['remove'])]
    private Collection $media;

    #[ORM\OneToMany(mappedBy: 'trickRelation', targetEntity: Comment::class, cascade: ['remove'])]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'trickRealtion')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $CreatedUser = null;

    #[ORM\ManyToOne(inversedBy: 'upTrickRelation')]
    private ?User $UpUser = null;

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }


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

    public function getCategory(): ?int
    {
        return $this->category;
    }

    public function setCategory(int $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->setTrickRelation($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getTrickRelation() === $this) {
                $medium->setTrickRelation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setTrickRelation($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTrickRelation() === $this) {
                $comment->setTrickRelation(null);
            }
        }

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

    public function getUpUser(): ?User
    {
        return $this->UpUser;
    }

    public function setUpUser(?User $UpUser): self
    {
        $this->UpUser = $UpUser;

        return $this;
    }

}
