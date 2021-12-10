<?php

namespace App\Entity;

use App\Repository\CovoiturageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CovoiturageRepository::class)
 */
class Covoiturage
{/**
 * @ORM\Id
 * @ORM\GeneratedValue
 * @ORM\Column(type="integer")
 */
    private $id_covoiturage;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arrive;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tarif;

    /**
     * @ORM\Column(type="integer")
     */
    private $longueurtrajet;

    /**
     * @ORM\Column(type="integer")
     */
    private $idveh;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbpsg;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getId_Covoiturage(): ?string
    {
        return $this->id_covoiturage;
    }

    public function setId_Covoiturage(?string $id_covoiturage): self
    {
        $this->depart = $id_covoiturage;

        return $this;
    }
    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(?string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getArrive(): ?string
    {
        return $this->arrive;
    }

    public function setArrive(string $arrive): self
    {
        $this->arrive = $arrive;

        return $this;
    }

    public function getLongueurtrajet(): ?int
    {
        return $this->longueurtrajet;
    }

    public function setLongueurtrajet(int $longueurtrajet): self
    {
        $this->longueurtrajet = $longueurtrajet;

        return $this;
    }


    public function getIdveh(): ?int
    {
        return $this->idveh;
    }

    public function setIdveh(int $idveh): self
    {
        $this->idveh = $idveh;

        return $this;
    }

    public function getNbpsg(): ?int
    {
        return $this->nbpsg;
    }

    public function setNbpsg(int $nbpsg): self
    {
        $this->nbpsg = $nbpsg;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif= $tarif;

        return $this;
    }
}
