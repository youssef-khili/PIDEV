<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id",type="integer")
     */
    private $id_veh;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_place;


    public function getId_Veh(): ?int
    {
        return $this->id_veh;
    }

    public function setIdVeh(int $id_veh): self
    {
        $this->id_veh = $id_veh;

        return $this;
    }
    public function get_Id_Veh(): ?int
    {
        return $this->id_veh;
    }

    public function set_Id_Veh(int $id_veh): self
    {
        $this->id_veh = $id_veh;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNb_Place(): ?int
    {
        return $this->nb_place;
    }

    public function setNbPlace(int $nb_place): self
    {
        $this->nb_place = $nb_place;

        return $this;
    }
    public function __construct()
    {
        // Rappelez-vous, on a un attribut qui doit contenir un ArrayCollection, on doit l'initialiser dans le constructeur
        $this->covoiturages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function addCovoiturage(\App\Entity\Covoiturage $covoiturage)
    {
        $this->covoiturages[] = $covoiturage;
        return $this;
    }
    public function removeCovoiturage(\App\Entity\Covoiturage  $covoiturage)
    {
        $this->Covoiturages->removeElement($covoiturage);
    }
    public function getCovoiturages()
    {
        return $this->covoiturages;
    }
    // …

}
