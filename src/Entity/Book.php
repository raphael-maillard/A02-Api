<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"book:read"}},
 *     denormalizationContext={"groups"={"book:write"}}
 * )
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customer:read", "book:read","book:write"})
     * @Assert\NotBlank(message="Le nom ne peut pas être vide")
     * @Assert\Length(min=3, minMessage="Le nom ne doit comporter au miniumum 3 caractères.", max = 255, maxMessage="Le nom doit comporter au maximum 255 caractères.")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customer:read", "book:read","book:write"})
     * @Assert\NotBlank(message="L'auteur ne peut pas être vide")
     * @Assert\Length(min=3, minMessage="L'auteur doit comporter au miniumum 3 caractères.", max = 255, maxMessage="L'auteur doit comporter au maximum 255 caractères.")
     */
    private $author;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"book:read","book:write"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customer:read", "book:read","book:write"})
     * @Assert\NotBlank(message="La catégorie ne peut pas être vide")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     * @Groups({"customer:read", "book:read","book:write"})
     * @Assert\NotBlank(message="Un résumé est nécessaire")
     */
    private $summary;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Customer::class, mappedBy="book")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private $customers;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="ISBN ne peut pas être vide")
     */
    private $isbn;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->addBook($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeBook($this);
        }

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }
}
