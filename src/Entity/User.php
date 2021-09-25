<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`users`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(180) NOT NULL")
    */
    private $email;
    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(180) NOT NULL")
    */
    private $name;

    public function __construct( string $email, string  $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    public static function create( string $email, string $name): self
    {
        var_dump("lllllllll");
        var_dump($email);
        return new self($email, $name);

    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function name(): ?string
    {
        return $this->name;
    }

}
