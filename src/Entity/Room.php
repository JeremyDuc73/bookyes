<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'room')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RoomKind $roomKind = null;

    #[ORM\ManyToMany(targetEntity: Bed::class, mappedBy: 'room')]
    private Collection $beds;

    public function __construct()
    {
        $this->beds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getRoomKind(): ?RoomKind
    {
        return $this->roomKind;
    }

    public function setRoomKind(?RoomKind $roomKind): static
    {
        $this->roomKind = $roomKind;

        return $this;
    }

    /**
     * @return Collection<int, Bed>
     */
    public function getBeds(): Collection
    {
        return $this->beds;
    }

    public function addBed(Bed $bed): static
    {
        if (!$this->beds->contains($bed)) {
            $this->beds->add($bed);
            $bed->addRoom($this);
        }

        return $this;
    }

    public function removeBed(Bed $bed): static
    {
        if ($this->beds->removeElement($bed)) {
            $bed->removeRoom($this);
        }

        return $this;
    }
}
