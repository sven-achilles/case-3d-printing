<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrintOrderRepository")
 */
class PrintOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=254)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\NotBlank()
     * @Assert\Length(min=7, max=7)
     */
    private $color;

    //private $material;

    //private $finish;

    /**
     * @ORM\Column(type="boolean")
     */
    private $polish;

    /**
     * @ORM\Column(type="decimal")
     * @Assert\NotBlank()
     */
    private $width;

    /**
     * @ORM\Column(type="decimal")
     * @Assert\NotBlank()
     */
    private $height;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="prints")
     * @ORM\JoinColumn()
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return boolean
     */
    public function getPolish()
    {
        return $this->polish;
    }

    /**
     * @param boolean $polish
     */
    public function setPolish($polish): void
    {
        $this->polish = $polish;
    }

    /**
     * @return double
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param double $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return double
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param double $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $createDate
     */
    public function setCreateDate($createDate): void
    {
        $this->createDate = $createDate;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
}
