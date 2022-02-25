<?php

namespace App\Entity;

use App\Repository\RockbandRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RockbandRepository::class)
 */
class Rockband
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="date")
     */
    private $startYear;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $yearOfSeparation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $founders;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $members;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $musicalMovement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $presentation;

    /**
     * @ORM\Column(type="string")
     */
    private $attachementFilename;

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

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStartYear(): ?\DateTimeInterface
    {
        return $this->startYear;
    }

    public function setStartYear(\DateTimeInterface $startYear): self
    {
        $this->startYear = $startYear;

        return $this;
    }

    public function getYearOfSeparation(): ?\DateTimeInterface
    {
        return $this->yearOfSeparation;
    }

    public function setYearOfSeparation(?\DateTimeInterface $yearOfSeparation): self
    {
        $this->yearOfSeparation = $yearOfSeparation;

        return $this;
    }

    public function getFounders(): ?string
    {
        return $this->founders;
    }

    public function setFounders(?string $founders): self
    {
        $this->founders = $founders;

        return $this;
    }

    public function getMembers(): ?int
    {
        return $this->members;
    }

    public function setMembers(?int $members): self
    {
        $this->members = $members;

        return $this;
    }

    public function getMusicalMovement(): ?string
    {
        return $this->musicalMovement;
    }

    public function setMusicalMovement(?string $musicalMovement): self
    {
        $this->musicalMovement = $musicalMovement;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }


    /**
     * Get the value of attachementFilename
     */ 
    public function getAttachementFilename()
    {
        return $this->attachementFilename;
    }

    /**
     * Set the value of attachementFilename
     *
     * @return  self
     */ 
    public function setAttachementFilename($attachementFilename)
    {
        $this->attachementFilename = $attachementFilename;

        return $this;
    }
}
