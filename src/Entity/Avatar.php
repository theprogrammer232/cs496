<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="avatar")
     */
    private $users;

    public function __construct()
    {
        $this->charCards = new ArrayCollection();
        $this->utilCards = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * @param mixed $image_path
     */
    public function setImagePath($image_path): void
    {
        $this->image_path = $image_path;
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAvatar($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getAvatar() === $this) {
                $user->setAvatar(null);
            }
        }

        return $this;
    }
}
