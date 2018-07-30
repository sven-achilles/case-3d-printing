<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=6)
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
     */
    private $width;

    /**
     * @ORM\Column(type="decimal")
     */
    private $height;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getPolish()
    {
        return $this->polish;
    }

    /**
     * @param mixed $polish
     */
    public function setPolish($polish): void
    {
        $this->polish = $polish;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }
}
