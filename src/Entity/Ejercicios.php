<?php

namespace App\Entity;

use App\Repository\EjerciciosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EjerciciosRepository::class)
 */
class Ejercicios
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CantidadRep::class, inversedBy="ejercicios")
     */
    private $cantidadRep;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $pesos;

    /**
     * @ORM\ManyToOne(targetEntity=Rondas::class, inversedBy="ejercicios")
     */
    private $rondas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getCantidadRep()." vueltas | ".$this->getNombre()." | ".$this->getPesos()." Kg";
    }

    public function getCantidadRep(): ?CantidadRep
    {
        return $this->cantidadRep;
    }

    public function setCantidadRep(?CantidadRep $cantidadRep): self
    {
        $this->cantidadRep = $cantidadRep;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPesos(): ?int
    {
        return $this->pesos;
    }

    public function setPesos(?int $pesos): self
    {
        $this->pesos = $pesos;

        return $this;
    }

    public function getRondas(): ?Rondas
    {
        return $this->rondas;
    }

    public function setRondas(?Rondas $rondas): self
    {
        $this->rondas = $rondas;

        return $this;
    }
}
