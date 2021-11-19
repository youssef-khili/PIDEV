<?php

namespace App\Entity;

use App\Repository\ActualiteeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActualiteeRepository::class)
 */
class Actualitee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="remplir le champ svp !!!!")
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = " must be at least {{ limit }} characters long",
     *      maxMessage = " cannot be longer than {{ limit }} characters"
     * )

     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=20)
     *  @Assert\NotEqualTo("music")
     *  @Assert\NotBlank(message="remplir le champ svp !!!!")
    @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = " must be at least {{ limit }} characters long",
     *      maxMessage = " cannot be longer than {{ limit }} characters")
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $type;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
