<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/** 
 * @ApiResource(
 *     normalizationContext={"groups"={"customer:read"}},
 *     denormalizationContext={"groups"={"customer:write"}}
 * )
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */

class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customer:read", "customer:write", "book:read"})
     * @Assert\NotBlank(message="Le nom ne peut pas être vide")
     * @Assert\Length(min=3, minMessage="Le nom ne doit comporter au miniumum 3 caractères.", max = 255, maxMessage="Le nom doit comporter au maximum 255 caractères.")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customer:read", "customer:write", "book:read"})
     * @Assert\NotBlank(message="Le prénom ne peut pas être vide")
     * @Assert\Length(min=3, minMessage="Le prénom ne doit comporter au miniumum 3 caractères.", max = 255, maxMessage="Le prénom doit comporter au maximum 255 caractères.")
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"customer:read", "customer:write"})
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"customer:write"})
     */
    private $ModifiedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, inversedBy="customers")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"customer:read", "customer:write"})
     * @Assert\NotBlank(message="Le livre est obligatoire")
     */
    private $book;

    public function __construct()
    {
        $this->book = new ArrayCollection();
        $this->setCreatedAt = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->ModifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $ModifiedAt): self
    {
        $this->ModifiedAt = $ModifiedAt;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBook(): Collection
    {
        return $this->book;
    }

    public function addBook(Book $book): self
    {
        if (!$this->book->contains($book)) {
            $this->book[] = $book;
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        $this->book->removeElement($book);

        return $this;
    }
}
