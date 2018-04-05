<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomCardRepository")
 */
class CustomCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="custom_card_users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CustomCardStat", inversedBy="custom_card_stats")
     * @ORM\JoinColumn(name="card_stat_id", referencedColumnName="id")
     */
    protected $card_stat_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $votes;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId(User $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCardStatId()
    {
        return $this->card_stat_id;
    }

    /**
     * @param mixed $card_stat_id
     */
    public function setCardStatId(CustomCardStat $card_stat_id): void
    {
        $this->card_stat_id = $card_stat_id;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes): void
    {
        $this->votes = $votes;
    }
}
