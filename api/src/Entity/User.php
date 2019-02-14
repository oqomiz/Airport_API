<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Table(name="app_users")
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="plain_password", type="string")
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="additional_roles", type="string", nullable=true)
     */
    private $additionalRoles;

    public function __construct($username)
    {
        $this->isActive = true;
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRoles()
    {
        $roles = [];
        if (!empty($this->additionalRoles)) {
            $roles = explode(',', $this->additionalRoles);
        }
        $roles = array_merge($roles, ['ROLE_USER']);

        return $roles;
    }

    public function eraseCredentials() {}

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getAdditionalRoles()
    {
        return $this->additionalRoles;
    }

    /**
     * @param mixed $additionalRoles
     */
    public function setAdditionalRoles($additionalRoles): void
    {
        $this->additionalRoles = $additionalRoles;
    }
}
