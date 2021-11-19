<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pub
 *
 * @ORM\Table(name="pub")
 * @ORM\Entity(repositoryClass="App\Repository\PubRepository")

 */
class Pub
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=30, nullable=false)
     * @Assert\NotEqualTo("publicite")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "le titree depublicité ne doit pas etre moins de {{ limit }} characters ",
     *      maxMessage = "le titree depublicité ne doit pas etre plus de {{ limit }} characters{{ limit }} characters"
     * )
     */
    private $titre;

    /**
     * @var string
     *  @Assert\NotBlank
     * @ORM\Column(name="description", type="string", length=30, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duree_pub", type="date", nullable=false)


     */
    private $dureePub;

    /**
     * @var int
     *
     * @ORM\Column(name="tarif", type="integer", nullable=false)
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "le tarif ne doit pas etre moins de {{ limit }} chiffres",
     *      maxMessage = "le tarif ne doit pas etre plus de {{ limit }} chiffres"
     * )
     */
    private $tarif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDureePub(): ?\DateTimeInterface
    {
        return $this->dureePub;
    }

    public function setDureePub(\DateTimeInterface $dureePub): self
    {
        $this->dureePub = $dureePub;

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
