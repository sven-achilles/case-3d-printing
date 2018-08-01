<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="This e-mail is already in used")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=254)
     * @Assert\Email()
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=4096)
     *
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=50)
     *
     * @var string
     */
    private $fullName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrintOrder", mappedBy="user")
     *
     * @var ArrayCollection
     */
    private $prints;

    public function __construct()
    {
        $this->prints = new ArrayCollection();
    }

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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail( $email ): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName( $fullName ): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @param string $password
     */
    public function setPassword( $password ): void
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return [
            'ROLE_USER',
        ];
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword( $plainPassword ): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrints()
    {
        return $this->prints;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list($this->id, $this->email, $this->password) = unserialize( $serialized );
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
