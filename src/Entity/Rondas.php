<?php

namespace App\Entity;

use App\Repository\RondasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RondasRepository::class)
 */
class Rondas
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
    private $cantidad;

    /**
     * @ORM\OneToMany(targetEntity=Ejercicios::class, mappedBy="rondas")
     */
    private $ejercicios;

    /**
     * @ORM\ManyToOne(targetEntity=Entrenamiento::class, inversedBy="rondas")
     */
    private $entrenamiento;

    public function __construct()
    {
        $this->ejercicios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getEntrenamiento()." | ".$this->getCantidad()." Rondas";
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * @return Collection<int, Ejercicios>
     */
    public function getEjercicios(): Collection
    {
        return $this->ejercicios;
    }

    public function addEjercicio(Ejercicios $ejercicio): self
    {
        if (!$this->ejercicios->contains($ejercicio)) {
            $this->ejercicios[] = $ejercicio;
            $ejercicio->setRondas($this);
        }

        return $this;
    }

    public function removeEjercicio(Ejercicios $ejercicio): self
    {
        if ($this->ejercicios->removeElement($ejercicio)) {
            // set the owning side to null (unless already changed)
            if ($ejercicio->getRondas() === $this) {
                $ejercicio->setRondas(null);
            }
        }

        return $this;
    }

    public function getEntrenamiento(): ?Entrenamiento
    {
        return $this->entrenamiento;
    }

    public function setEntrenamiento(?Entrenamiento $entrenamiento): self
    {
        $this->entrenamiento = $entrenamiento;

        return $this;
    }
}
