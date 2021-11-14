<?php

namespace App\Entity;

use App\Repository\WorkPlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkPlaceRepository::class)
 */
class WorkPlace
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
     * @ORM\Column(type="float")
     */
    private $min_earnings;

    /**
     * @ORM\OneToMany(targetEntity=Worker::class, mappedBy="workPlace")
     */
    private $workers;

    public function __construct()
    {
        $this->workers = new ArrayCollection();
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

    public function getMinEarnings(): ?float
    {
        return $this->min_earnings;
    }

    public function setMinEarnings(float $min_earnings): self
    {
        $this->min_earnings = $min_earnings;

        return $this;
    }

    /**
     * @return Collection|Worker[]
     */
    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    public function addWorker(Worker $worker): self
    {
        if (!$this->workers->contains($worker)) {
            $this->workers[] = $worker;
            $worker->setWorkPlace($this);
        }

        return $this;
    }

    public function removeWorker(Worker $worker): self
    {
        if ($this->workers->removeElement($worker)) {
            // set the owning side to null (unless already changed)
            if ($worker->getWorkPlace() === $this) {
                $worker->setWorkPlace(null);
            }
        }

        return $this;
    }
}
