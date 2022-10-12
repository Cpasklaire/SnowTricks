<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $Pseudo = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    public ?string $confirmPassword = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class)]
    private Collection $CommentRelation;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Media::class)]
    private Collection $MediaRelation;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Trick::class)]
    private Collection $TrickRelation;

    public function __construct()
    {
        $this->CommentRelation = new ArrayCollection();
        $this->MediaRelation = new ArrayCollection();
        $this->TrickRelation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): self
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->Pseudo;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getCommentRelation(): Collection
    {
        return $this->CommentRelation;
    }

    public function addCommentRelation(Comment $commentRelation): self
    {
        if (!$this->CommentRelation->contains($commentRelation)) {
            $this->CommentRelation->add($commentRelation);
            $commentRelation->setUser($this);
        }

        return $this;
    }

    public function removeCommentRelation(Comment $commentRelation): self
    {
        if ($this->CommentRelation->removeElement($commentRelation)) {
            // set the owning side to null (unless already changed)
            if ($commentRelation->getUser() === $this) {
                $commentRelation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMediaRelation(): Collection
    {
        return $this->MediaRelation;
    }

    public function addMediaRelation(Media $mediaRelation): self
    {
        if (!$this->MediaRelation->contains($mediaRelation)) {
            $this->MediaRelation->add($mediaRelation);
            $mediaRelation->setUser($this);
        }

        return $this;
    }

    public function removeMediaRelation(Media $mediaRelation): self
    {
        if ($this->MediaRelation->removeElement($mediaRelation)) {
            // set the owning side to null (unless already changed)
            if ($mediaRelation->getUser() === $this) {
                $mediaRelation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Trick>
     */
    public function getTrickRelation(): Collection
    {
        return $this->TrickRelation;
    }

    public function addTrickRelation(Trick $trickRelation): self
    {
        if (!$this->TrickRelation->contains($trickRelation)) {
            $this->TrickRelation->add($trickRelation);
            $trickRelation->setUser($this);
        }

        return $this;
    }

    public function removeTrickRelation(Trick $trickRelation): self
    {
        if ($this->TrickRelation->removeElement($trickRelation)) {
            // set the owning side to null (unless already changed)
            if ($trickRelation->getUser() === $this) {
                $trickRelation->setUser(null);
            }
        }

        return $this;
    }
}
