<?php

namespace App\Entity;

use App\Repository\LitterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LitterRepository::class)
 */
class Litter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dad;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbFemale;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbMale;

    /**
     * @ORM\Column(type="date")
     */
    private $birth;

    /**
     * @ORM\ManyToOne(targetEntity=dog::class, inversedBy="litters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dog;

    /**
     * @ORM\OneToMany(targetEntity=Puppy::class, mappedBy="litter")
     */
    private $puppies;

    public function __construct()
    {
        $this->puppies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMom(): ?string
    {
        return $this->mom;
    }

    public function setMom(string $mom): self
    {
        $this->mom = $mom;

        return $this;
    }

    public function getDad(): ?string
    {
        return $this->dad;
    }

    public function setDad(string $dad): self
    {
        $this->dad = $dad;

        return $this;
    }

    public function getNbFemale(): ?int
    {
        return $this->nbFemale;
    }

    public function setNbFemale(?int $nbFemale): self
    {
        $this->nbFemale = $nbFemale;

        return $this;
    }

    public function getNbMale(): ?int
    {
        return $this->nbMale;
    }

    public function setNbMale(?int $nbMale): self
    {
        $this->nbMale = $nbMale;

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

    public function getDog(): ?dog
    {
        return $this->dog;
    }

    public function setDog(?dog $dog): self
    {
        $this->dog = $dog;

        return $this;
    }

    /**
     * @return Collection|Puppy[]
     */
    public function getPuppies(): Collection
    {
        return $this->puppies;
    }

    public function addPuppy(Puppy $puppy): self
    {
        if (!$this->puppies->contains($puppy)) {
            $this->puppies[] = $puppy;
            $puppy->setLitter($this);
        }

        return $this;
    }

    public function removePuppy(Puppy $puppy): self
    {
        if ($this->puppies->removeElement($puppy)) {
            // set the owning side to null (unless already changed)
            if ($puppy->getLitter() === $this) {
                $puppy->setLitter(null);
            }
        }

        return $this;
    }
}
