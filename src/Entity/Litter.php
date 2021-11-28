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
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbFemale;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbMale;

    /**
     * @ORM\ManyToOne(targetEntity=Dog::class, inversedBy="litters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dogMom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\ManyToOne(targetEntity=Dog::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $dad;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDogMom(): ?Dog
    {
        return $this->dogMom;
    }

    public function setDogMom(?Dog $dogMom): self
    {
        $this->dogMom = $dogMom;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getDad(): ?dog
    {
        return $this->dad;
    }

    public function setDad(?dog $dad): self
    {
        $this->dad = $dad;

        return $this;
    }
}
