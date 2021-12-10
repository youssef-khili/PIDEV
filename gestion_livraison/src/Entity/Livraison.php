<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 */
class Livraison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "le depart ne peux pas etre moin de {{ limit }} characters ",
     *      maxMessage = "le depart ne peux pas etre plus de {{ limit }} characters"
     * )
     */
    private $depart;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "le arrivé ne peux pas etre moin de {{ limit }} characters ",
     *      maxMessage = "le arrivé ne peux pas etre plus de {{ limit }} characters"
     * )
     */
    private $arrive;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "le type de l'objet ne peux pas etre moin de {{ limit }} characters ",
     *      maxMessage = "le type de l'objet ne peux pas etre plus de {{ limit }} characters"
     * )
     */
    private $type_objet;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "le emplacement ne peux pas etre moin de {{ limit }} characters ",
     *      maxMessage = "le emplacement ne peux pas etre plus de {{ limit }} characters"
     * )
     */
    private $emplacement_et_etat;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 8,
     *      minMessage = "le poids ne peux pas etre moin de {{ limit }} chiffre",
     *      maxMessage = "le poids ne peux pas etre plus de {{ limit }} chiffre"
     * )
     */
    private $poids_unitaire;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 4,
     *      minMessage = "le tarif ne peux pas etre moin de {{ limit }} chiffre",
     *      maxMessage = "le tarif ne peux pas etre plus de {{ limit }} chiffre"
     * )
     */
    private $tarif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(string $depart): self
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

    public function getTypeObjet(): ?string
    {
        return $this->type_objet;
    }

    public function setTypeObjet(string $type_objet): self
    {
        $this->type_objet = $type_objet;

        return $this;
    }
    public function getType_objet(): ?string
    {
        return $this->type_objet;
    }

    public function setType_objet(string $type_objet): self
    {
        $this->type_objet = $type_objet;

        return $this;
    }

    public function getEmplacementEtEtat(): ?string
    {
        return $this->emplacement_et_etat;
    }

    public function setEmplacementEtEtat(string $emplacement_et_etat): self
    {
        $this->emplacement_et_etat = $emplacement_et_etat;

        return $this;
    }
    public function getEmplacement_et_etat(): ?string
    {
        return $this->emplacement_et_etat;
    }

    public function setEmplacement_et_etat(string $emplacement_et_etat): self
    {
        $this->emplacement_et_etat = $emplacement_et_etat;

        return $this;
    }

    public function getPoidsUnitaire(): ?int
    {
        return $this->poids_unitaire;
    }

    public function setPoidsUnitaire(int $poids_unitaire): self
    {
        $this->poids_unitaire = $poids_unitaire;

        return $this;
    }
    public function getPoids_unitaire(): ?int
    {
        return $this->poids_unitaire;
    }

    public function setPoids_unitaire(int $poids_unitaire): self
    {
        $this->poids_unitaire = $poids_unitaire;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }
}
