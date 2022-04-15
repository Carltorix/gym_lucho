<?php

namespace App\Entity;

use App\Repository\CantidadRepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CantidadRepRepository::class)
 */
class CantidadRep
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Ejercicios::class, mappedBy="cantidadRep")
     */
    private $ejercicios;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $repeticiones;

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
        return $this->getRepeticiones();
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
            $ejercicio->setCantidadRep($this);
        }

        return $this;
    }

    public function removeEjercicio(Ejercicios $ejercicio): self
    {
        if ($this->ejercicios->removeElement($ejercicio)) {
            // set the owning side to null (unless already changed)
            if ($ejercicio->getCantidadRep() === $this) {
                $ejercicio->setCantidadRep(null);
            }
        }

        return $this;
    }

    public function getRepeticiones(): ?string
    {
        return $this->repeticiones;
    }

    public function setRepeticiones(?string $repeticiones): self
    {
        $this->repeticiones = $repeticiones;

        return $this;
    }

}
