<?php

namespace App\Entity;

use App\Repository\EntrenamientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrenamientoRepository::class)
 */
class Entrenamiento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TiposEntrenamiento::class, inversedBy="entrenamientos")
     */
    private $tipoEntrenamiento;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dia;

    /**
     * @ORM\OneToMany(targetEntity=Rondas::class, mappedBy="entrenamiento")
     */
    private $rondas;

    public function __construct()
    {
        $this->rondas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getTipoEntrenamiento()." | ".$this->getDia();
    }

    public function getTipoEntrenamiento(): ?TiposEntrenamiento
    {
        return $this->tipoEntrenamiento;
    }

    public function setTipoEntrenamiento(?TiposEntrenamiento $tipoEntrenamiento): self
    {
        $this->tipoEntrenamiento = $tipoEntrenamiento;

        return $this;
    }

    public function getDia(): ?\DateTimeInterface
    {
        return $this->dia;
    }

    public function setDia(?\DateTimeInterface $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * @return Collection<int, Rondas>
     */
    public function getRondas(): Collection
    {
        return $this->rondas;
    }

    public function addRonda(Rondas $ronda): self
    {
        if (!$this->rondas->contains($ronda)) {
            $this->rondas[] = $ronda;
            $ronda->setEntrenamiento($this);
        }

        return $this;
    }

    public function removeRonda(Rondas $ronda): self
    {
        if ($this->rondas->removeElement($ronda)) {
            // set the owning side to null (unless already changed)
            if ($ronda->getEntrenamiento() === $this) {
                $ronda->setEntrenamiento(null);
            }
        }

        return $this;
    }

}
