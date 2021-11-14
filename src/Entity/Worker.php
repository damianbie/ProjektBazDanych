<?php

namespace App\Entity;

use App\Repository\WorkerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkerRepository::class)
 */
class Worker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\ManyToOne(targetEntity=WorkPlace::class, inversedBy="workers")
     */
    private $workPlace;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $hiredAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $bonus;


    public function __construct()
    {
        $this->workPlace = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection|WorkPlace[]
     */
    public function getWorkPlace(): Collection
    {
        return $this->workPlace;
    }

    public function addWorkPlace(WorkPlace $workPlace): self
    {
        if (!$this->workPlace->contains($workPlace)) {
            $this->workPlace[] = $workPlace;
            $workPlace->setWorker($this);
        }

        return $this;
    }

    public function removeWorkPlace(WorkPlace $workPlace): self
    {
        if ($this->workPlace->removeElement($workPlace)) {
            // set the owning side to null (unless already changed)
            if ($workPlace->getWorker() === $this) {
                $workPlace->setWorker(null);
            }
        }

        return $this;
    }

    public function setWorkPlace(?WorkPlace $workPlace): self
    {
        $this->workPlace = $workPlace;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getHiredAt(): ?\DateTimeImmutable
    {
        return $this->hiredAt;
    }

    public function setHiredAt(\DateTimeImmutable $hiredAt): self
    {
        $this->hiredAt = $hiredAt;

        return $this;
    }

    public function getBonus(): ?float
    {
        return $this->bonus;
    }

    public function setBonus(?float $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }
}
