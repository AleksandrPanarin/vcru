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
     * @var int $amountShow
     * @ORM\Column(type="integer", name="amount_show")
     */
    private $amountShow;

    /**
     * @var string $banner
     * @ORM\Column(type="string")
     */
    private $banner;

    public function __construct()
    {
        $this->amountShow = 0;
    }

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
     * @param int $amountShow
     * @return $this
     */
    public function setAmountShow(int $amountShow): self
    {
        $this->amountShow = $amountShow;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmountShow(): int
    {
        return $this->amountShow;
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

    /**
     * @return string
     */
    public function getHostBanner(): string
    {
        return REQUEST_SCHEME_HOST . DIRECTORY_SEPARATOR . $this->getBanner();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'text' => $this->getText(),
            'price' => $this->getPrice(),
            'amount' => $this->getAmount(),
            'amountShow' => $this->getAmountShow(),
            'banner' => $this->getHostBanner(),
        ];
    }
}