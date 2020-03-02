<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $name_role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAccountCreation", mappedBy="yes")
     */
    private $role_type;

    public function __construct()
    {
        $this->role_type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNameRole(): ?string
    {
        return $this->name_role;
    }
    public function setNameRole(string $name_role): self
    {
        $this->name_role = $name_role;

        return $this;    }
    /**
     * @return Collection|UserAccountCreation[]
     */
    public function getRoleType(): Collection
    {
        return $this->role_type;
    }
    public function addRoleType(UserAccountCreation $roleType): self
    {
        if (!$this->role_type->contains($roleType)) {
            $this->role_type[] = $roleType;
            $roleType->setYes($this);
        }
        return $this;
    }

    public function removeRoleType(UserAccountCreation $roleType): self
    {
        if ($this->role_type->contains($roleType)) {
            $this->role_type->removeElement($roleType);
            // set the owning side to null (unless already changed)
            if ($roleType->getYes() === $this) {
                $roleType->setYes(null);
            }
        }

        return $this;
    }

}
