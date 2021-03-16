<?php

namespace App\Entity;

use App\Repository\DogRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DogRepository::class)
 * @Vich\Uploadable()
 */
class Dog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */

    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=4, max=100, minMessage="Il faut au moins 4 lettres pour un nom de chien ! ")
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $birth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $breed;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $breeder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lof;

    /**
     * @ORM\OneToMany(targetEntity=Litter::class, mappedBy="dog")
     */
    private $litters;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    public function __construct()
    {
        $this->litters = new ArrayCollection();
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

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(\DateTimeInterface $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(string $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getBreeder(): ?string
    {
        return $this->breeder;
    }

    public function setBreeder(string $breeder): self
    {
        $this->breeder = $breeder;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getLof(): ?string
    {
        return $this->lof;
    }

    public function setLof(string $lof): self
    {
        $this->lof = $lof;

        return $this;
    }

    /**
     * @return Collection|Litter[]
     */
    public function getLitters(): Collection
    {
        return $this->litters;
    }

    public function addLitter(Litter $litter): self
    {
        if (!$this->litters->contains($litter)) {
            $this->litters[] = $litter;
            $litter->setDog($this);
        }

        return $this;
    }

    public function removeLitter(Litter $litter): self
    {
        if ($this->litters->removeElement($litter)) {
            // set the owning side to null (unless already changed)
            if ($litter->getDog() === $this) {
                $litter->setDog(null);
            }
        }

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
