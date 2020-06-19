<?php

namespace App\Entity;

use App\Repository\TrasaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrasaRepository::class)
 */
class Trasa
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
    private $start;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $opis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $legenda;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Kurs", mappedBy="trasa")
     */
    private $kurs;

    public function __construct()
    {
        $this->kurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function setEnd(string $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(string $opis): self
    {
        $this->opis = $opis;

        return $this;
    }

    public function getLegenda(): ?string
    {
        return $this->legenda;
    }

    public function setLegenda(string $legenda): self
    {
        $this->legenda = $legenda;

        return $this;
    }

    /**
     * @return Collection|Kurs[]
     */
    public function getKurs(): Collection
    {
        return $this->kurs;
    }

    public function addKur(Kurs $kur): self
    {
        if (!$this->kurs->contains($kur)) {
            $this->kurs[] = $kur;
            $kur->setTrasa($this);
        }

        return $this;
    }

    public function removeKur(Kurs $kur): self
    {
        if ($this->kurs->contains($kur)) {
            $this->kurs->removeElement($kur);
            // set the owning side to null (unless already changed)
            if ($kur->getTrasa() === $this) {
                $kur->setTrasa(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->start . ' - ' . $this->end;
    }
}
