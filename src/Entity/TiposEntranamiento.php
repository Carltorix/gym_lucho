<?php

namespace App\Entity;

use App\Repository\TiposEntrenamientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TiposEntrenamientoRepository::class)
 */
class TiposEntrenamiento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_de_entranamiento;

    /**
     * @ORM\OneToMany(targetEntity=Entrenamiento::class, mappedBy="tipoEntrenamiento")
     */
    private $entrenamientos;

    public function __construct()
    {
        $this->entrenamientos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getTipoDeEntranamiento();
    }

    public function getTipoDeEntranamiento(): ?string
    {
        return $this->tipo_de_entranamiento;
    }

    public function setTipoDeEntranamiento(?string $tipo_de_entranamiento): self
    {
        $this->tipo_de_entranamiento = $tipo_de_entranamiento;

        return $this;
    }

    /**
     * @return Collection<int, Entrenamiento>
     */
    public function getEntrenamientos(): Collection
    {
        return $this->entrenamientos;
    }

    public function addEntrenamiento(Entrenamiento $entrenamiento): self
    {
        if (!$this->entrenamientos->contains($entrenamiento)) {
            $this->entrenamientos[] = $entrenamiento;
            $entrenamiento->setTipoEntrenamiento($this);
        }

        return $this;
    }

    public function removeEntrenamiento(Entrenamiento $entrenamiento): self
    {
        if ($this->entrenamientos->removeElement($entrenamiento)) {
            // set the owning side to null (unless already changed)
            if ($entrenamiento->getTipoEntrenamiento() === $this) {
                $entrenamiento->setTipoEntrenamiento(null);
            }
        }

        return $this;
    }
}
