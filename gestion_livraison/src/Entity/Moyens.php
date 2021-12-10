<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Moyens
 *
 * @ORM\Table(name="moyens")
 * @ORM\Entity
 */
class Moyens
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
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     * @Assert\NotEqualTo("taxi")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "le type de moyen de transport ne peux pas etre moin de {{ limit }} characters ",
     *      maxMessage = "le type de moyen de transport ne peux pas etre plus de {{ limit }} characters"
     * )
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=30, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "le lieu de depart ne peux pas etre moin de  {{ limit }} characters ",
     *      maxMessage = "le lieu de depart ne peux pas etre plus de  {{ limit }} characters"
     * )
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="arrive", type="string", length=30, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "le lieu d'arrive ne peux pas etre moin de {{ limit }} characters ",
     *      maxMessage = "le lieu d'arrive ne peux pas etre plus de {{ limit }} characters"
     * )
     */
    private $arrive;

    /**
     * @var string
     *
     * @ORM\Column(name="tarif", type="string", length=30, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "le tariff ne peux pas etre moin de {{ limit }} chiffre",
     *      maxMessage = "le tariff ne peux pas etre plus de {{ limit }} chiffre"
     * )
     */
    private $tarif;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }


}
