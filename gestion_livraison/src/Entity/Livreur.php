<?php

namespace App\Entity;

use App\Repository\LivreurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LivreurRepository::class)
 */
class Livreur
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
     *      minMessage = "le nom ne peux pas etre moin de {{ limit }} characters ",
     *      maxMessage = "le nom ne peux pas etre plus de {{ limit }} characters"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "le prenom ne peux pas etre moin de {{ limit }} characters ",
     *      maxMessage = "le prenom ne peux pas etre plus de {{ limit }} characters"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "le numero de tel ne peux pas etre moin de {{ limit }} chiffre",
     *      maxMessage = "le numero de tel ne peux pas etre plus de {{ limit }} chiffre"
     * )
     */
    private $num_tel;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "le CIN ne peux pas etre moin de {{ limit }} chiffre",
     *      maxMessage = "le CIN ne peux pas etre plus de {{ limit }} chiffre"
     * )
     */
    private $cin;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 2,
     *      minMessage = "le rate ne peux pas etre moin de {{ limit }} chiffre",
     *      maxMessage = "le rate ne peux pas etre plus de {{ limit }} chiffre"
     * )
     */
    private $rate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->num_tel;
    }

    public function setNumTel(int $num_tel): self
    {
        $this->num_tel = $num_tel;

        return $this;
    }
    public function getNum_tel(): ?int
    {
        return $this->num_tel;
    }

    public function setNum_tel(int $num_tel): self
    {
        $this->num_tel = $num_tel;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
