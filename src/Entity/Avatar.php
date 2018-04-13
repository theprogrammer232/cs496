<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvatarRepository")
 */
class Avatar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_path;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharCard", mappedBy="avatar", orphanRemoval=true)
     */
    private $charCards;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UtilCard", mappedBy="avatar", orphanRemoval=true)
     */
    private $utilCards;

    public function __construct()
    {
        $this->charCards = new ArrayCollection();
        $this->utilCards = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function setImagePath(?string $image_path): self
    {
        $this->image_path = $image_path;

        return $this;
    }

    /**
     * @return Collection|CharCard[]
     */
    public function getCharCards(): Collection
    {
        return $this->charCards;
    }

    public function addCharCard(CharCard $charCard): self
    {
        if (!$this->charCards->contains($charCard)) {
            $this->charCards[] = $charCard;
            $charCard->setAvatar($this);
        }

        return $this;
    }

    public function removeCharCard(CharCard $charCard): self
    {
        if ($this->charCards->contains($charCard)) {
            $this->charCards->removeElement($charCard);
            // set the owning side to null (unless already changed)
            if ($charCard->getAvatar() === $this) {
                $charCard->setAvatar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UtilCard[]
     */
    public function getUtilCards(): Collection
    {
        return $this->utilCards;
    }

    public function addUtilCard(UtilCard $utilCard): self
    {
        if (!$this->utilCards->contains($utilCard)) {
            $this->utilCards[] = $utilCard;
            $utilCard->setAvatar($this);
        }

        return $this;
    }

    public function removeUtilCard(UtilCard $utilCard): self
    {
        if ($this->utilCards->contains($utilCard)) {
            $this->utilCards->removeElement($utilCard);
            // set the owning side to null (unless already changed)
            if ($utilCard->getAvatar() === $this) {
                $utilCard->setAvatar(null);
            }
        }

        return $this;
    }
}