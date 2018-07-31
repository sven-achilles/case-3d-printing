<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrintOrderRepository")
 */
class PrintOrder
{
    const MATERIAL_PLASTIC      = 'plastic';
    const MATERIAL_FINE_PLASTIC = 'fine plastic';
    const MATERIAL_ALUMINUM     = 'aluminum';
    const MATERIAL_SAND_STONE   = 'sand stone';

    const FINISH_NONE     = 'none';
    const FINISH_PLASTIC  = 'plastic';
    const FINISH_PLATINUM = 'platinum';
    const FINISH_GOLD     = 'gold';
    const FINISH_SILVER   = 'silver';
    const FINISH_BRASS    = 'brass';
    const FINISH_BRONZE   = 'bronze';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the 3D design as a STL file.", groups={ "creation" })
     * @Assert\File(mimeTypes={ "application/vnd.ms-pkistl", "application/octet-stream" }, maxSize="50M", groups={ "creation" })
     *
     * @var string
     */
    private $design;

    /**
     * @ORM\Column(type="string", length=200)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=254)
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=7)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=7, max=7)
     *
     * @var string
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=25)
     *
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $material;

    /**
     * @ORM\Column(type="string", length=25)
     *
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $finish;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var boolean
     */
    private $polish;

    /**
     * @ORM\Column(type="decimal")
     *
     * @Assert\NotBlank()
     *
     * @var double
     */
    private $width;

    /**
     * @ORM\Column(type="decimal")
     *
     * @Assert\NotBlank()
     *
     * @var double
     */
    private $height;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $createDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="prints")
     * @ORM\JoinColumn()
     *
     * @var \App\Entity\User
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
     * @return string|\Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getDesign()
    {
        return $this->design;
    }

    /**
     * @param string $design
     */
    public function setDesign($design): void
    {
        $this->design = $design;
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
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param string $material
     */
    public function setMaterial($material): void
    {
        $this->material = $material;
    }

    /**
     * @return string
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * @param string $finish
     */
    public function setFinish($finish): void
    {
        $this->finish = $finish;
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
