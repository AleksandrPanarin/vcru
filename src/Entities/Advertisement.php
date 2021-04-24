<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\AdvertisementRepository")
 * @ORM\Table(name="advertisement")
 **/
class Advertisement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int $id
     */
    private $id;

    /**
     * @var string $text
     * @ORM\Column(type="string", length=255)
     */
    private $text;

    /**
     * @var float $price
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @var int $amount
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @var string $banner
     * @ORM\Column(type="string")
     */
    private $banner;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $text
     * @return Advertisement
     */
    public function setText(string $text): Advertisement
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param float $price
     * @return Advertisement
     */
    public function setPrice(float $price): Advertisement
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param int $amount
     * @return Advertisement
     */
    public function setAmount(int $amount): Advertisement
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param string $banner
     * @return Advertisement
     */
    public function setBanner(string $banner): Advertisement
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * @return string
     */
    public function getBanner(): string
    {
        return $this->banner;
    }


}