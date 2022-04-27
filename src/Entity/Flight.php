<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlightRepository::class)]
class Flight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $departureDateTime;


    #[ORM\Column(type: 'datetime')]
    private $arrivalDateTime;

    #[ORM\ManyToOne(targetEntity: City::class, inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: false)]
    private $departureCity;

    #[ORM\ManyToOne(targetEntity: City::class, inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: false)]
    private $arrivalCity;

    #[ORM\Column(type: 'decimal', precision: 8, scale: 2)]
    private $price;

    #[ORM\Column(type: 'boolean')]
    private $reduction;

    #[ORM\Column(type: 'integer')]
    private $seatMax;

    #[ORM\Column(type: 'string', length: 6)]
    private $FlightNumber;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartureDateTime(): ?\DateTimeInterface
    {
        return $this->departureDateTime;
    }

    public function setDepartureDateTime(\DateTimeInterface $departureDateTime): self
    {
        $this->departureDateTime = $departureDateTime;

        return $this;
    }

    public function getArrivalDateTime(): ?\DateTimeInterface
    {
        return $this->arrivalDateTime;
    }

    public function setArrivalDateTime(\DateTimeInterface $arrivalDateTime): self
    {
        $this->arrivalDateTime = $arrivalDateTime;

        return $this;
    }

    public function getDepartureCity(): ?City
    {
        return $this->departureCity;
    }

    public function setDepartureCity(?City $departureCity): self
    {
        $this->departureCity = $departureCity;

        return $this;
    }

    public function getArrivalCity(): ?City
    {
        return $this->arrivalCity;
    }

    public function setArrivalCity(?City $arrivalCity): self
    {
        $this->arrivalCity = $arrivalCity;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getReduction(): ?bool
    {
        return $this->reduction;
    }

    public function setReduction(bool $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getSeatMax(): ?int
    {
        return $this->seatMax;
    }

    public function setSeatMax(int $seatMax): self
    {
        $this->seatMax = $seatMax;

        return $this;
    }

    public function getFlightNumber(): ?string
    {
        return $this->FlightNumber;
    }

    public function setFlightNumber(string $FlightNumber): self
    {
        $this->FlightNumber = $FlightNumber;

        return $this;
    }
}
