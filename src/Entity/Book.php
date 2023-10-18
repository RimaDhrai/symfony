<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $publicationDate = null;

    #[ORM\Column]
    private ?bool $published = null;
   
    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Author $refbook = null;

    #[ORM\ManyToMany(targetEntity: Reader::class, inversedBy: 'books')]
    private Collection $idR;

    public function __construct()
    {
        $this->idR = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): static
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): static
    {
        $this->published = $published;

        return $this;
    }

    public function getRefbook(): ?Author
    {
        return $this->refbook;
    }

    public function setRefbook(?Author $refbook): static
    {
        $this->refbook = $refbook;

        return $this;
    }

    /**
     * @return Collection<int, Reader>
     */
    public function getIdR(): Collection
    {
        return $this->idR;
    }

    public function addIdR(Reader $idR): static
    {
        if (!$this->idR->contains($idR)) {
            $this->idR->add($idR);
        }

        return $this;
    }

    public function removeIdR(Reader $idR): static
    {
        $this->idR->removeElement($idR);

        return $this;
    }
   
}
