<?php
namespace App\Entity;
class PlaceSearch
{
    /**
     * @var int|null
     */
    private $minnbplace;
    /**
     * @var int|null
     */
    private $maxnbplace;

    public function getMinnbplace(): ?int
    {
        return $this->minnbplace;
    }
    public function setMinnbplace(int $minnbplace): self
    { $this->minnbplace = $minnbplace;
        return $this;
    }
    public function getMaxnbplace(): ?int
    {
        return $this->maxnbplace;
    }
    public function setMaxnbplace(int $maxnbplace): self
    {
        $this->maxnbplace = $maxnbplace;
        return $this;
    }
}