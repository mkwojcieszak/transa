<?php

namespace App\Entity;

use App\Repository\KursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KursRepository::class)
 */
class Kurs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $czas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $symbole;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trasa", inversedBy="kurs")
     */
    private $trasa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCzas(): ?string
    {
        return $this->czas;
    }

    public function setCzas(string $czas): self
    {
        $this->czas = $czas;

        return $this;
    }

    public function getSymbole(): ?string
    {
        return $this->symbole;
    }

    public function setSymbole(string $symbole): self
    {
        $this->symbole = $symbole;

        return $this;
    }

    public function getTrasa(): ?Trasa
    {
        return $this->trasa;
    }

    public function setTrasa(?Trasa $trasa): self
    {
        $this->trasa = $trasa;

        return $this;
    }
}
