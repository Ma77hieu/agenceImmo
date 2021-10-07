<?php

namespace App\Entity;

use App\Repository\SearchPropertyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SearchPropertyRepository::class)
 */
class SearchProperty
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $min_surface;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max_surface;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $min_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $min_rooms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max_rooms;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinSurface(): ?int
    {
        return $this->min_surface;
    }

    public function setMinSurface(?int $min_surface): self
    {
        $this->min_surface = $min_surface;

        return $this;
    }

    public function getMaxSurface(): ?int
    {
        return $this->max_surface;
    }

    public function setMaxSurface(?int $max_surface): self
    {
        $this->max_surface = $max_surface;

        return $this;
    }

    public function getMinPrice(): ?int
    {
        return $this->min_price;
    }

    public function setMinPrice(int $min_price): self
    {
        $this->min_price = $min_price;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->max_price;
    }

    public function setMaxPrice(?int $max_price): self
    {
        $this->max_price = $max_price;

        return $this;
    }

    public function getMinRooms(): ?int
    {
        return $this->min_rooms;
    }

    public function setMinRooms(?int $min_rooms): self
    {
        $this->min_rooms = $min_rooms;

        return $this;
    }

    public function getMaxRooms(): ?int
    {
        return $this->max_rooms;
    }

    public function setMaxRooms(?int $max_rooms): self
    {
        $this->max_rooms = $max_rooms;

        return $this;
    }
}
