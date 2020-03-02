<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAccountCreationRepository")
 */
class UserAccountCreation implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=190)
     *
     * @Assert\NotBlank(message="Champs obligatoire")
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=190)-idName
     *
     *  @Assert\NotBlank(message="Champs obligatoire")
     *
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=190)
     *
     *  @Assert\NotBlank(message="Champs obligatoire")
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=190)
     *
     * @Assert\NotBlank(message="Champs obligatoire")
     *
     */
    private $function;

    /**
     * @ORM\Column(type="string", length=190)
     *
     * @Assert\NotBlank(message="Champs obligatoire")
     *
     */
    private $name_society;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $address_society;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $phone_society;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $coach_name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $coaching_beginning;

    /**
     * @ORM\Column(type="string", length=190)
     *
     * @Assert\NotBlank(message="Champs obligatoire")
     *
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\NotBlank(message="Champs obligatoire")
     *
     */
    private $accept_terms;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $username;
    /**
     * @ORM\Column(type="json_array")
     */

    private $roles = array();

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $apiToken;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserEnergyValuesCreation", mappedBy="user_id")
     */
    private $strengths;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserActionPlanCreation", mappedBy="user_actions_id")
     */
    private $actions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserObjectiveCreation", mappedBy="user_objective_id")
     */
    private $objectives;

    public function __construct()
    {
        $this->strengths = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->objectives = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param mixed $apiToken
     */
    public function setApiToken($apiToken): void
    {
        $this->apiToken = $apiToken;
    }



    public function getId() : int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function setFunction(string $function): self
    {
        $this->function = $function;

        return $this;
    }

    public function getNameSociety(): ?string
    {
        return $this->name_society;
    }

    public function setNameSociety(string $name_society): self
    {
        $this->name_society = $name_society;

        return $this;
    }

    public function getAddressSociety(): ?string
    {
        return $this->address_society;
    }

    public function setAddressSociety(string $address_society): self
    {
        $this->address_society = $address_society;

        return $this;
    }

    public function getPhoneSociety(): ?string
    {
        return $this->phone_society;
    }

    public function setPhoneSociety(?string $phone_society): self
    {
        $this->phone_society = $phone_society;

        return $this;
    }

    public function getCoachName(): ?string
    {
        return $this->coach_name;
    }

    public function setCoachName(?string $coach_name): self
    {
        $this->coach_name = $coach_name;

        return $this;
    }

    public function getCoachingBeginning(): ?string
    {
        return $this->coaching_beginning;
    }

    public function setCoachingBeginning(?string $coaching_beginning): self
    {
        $this->coaching_beginning = $coaching_beginning;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAcceptTerms(): ?bool
    {
        return $this->accept_terms;
    }

    public function setAcceptTerms(bool $accept_terms): self
    {
        $this->accept_terms = $accept_terms;

        return $this;
    }
    /**
     * Returns the roles or permissions granted to the user for security.
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantees that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = ['ROLE_USER','ROLE_ADMIN'];
        }
        return array_unique($roles);
    }
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function encodePassword(string $raw, ?string $salt)
    {
        // TODO: Implement encodePassword() method.
    }

    /**
     * @inheritDoc
     */
    public function isPasswordValid(string $encoded, string $raw, ?string $salt)
    {
        // TODO: Implement isPasswordValid() method.
    }

    /**
     * @inheritDoc
     */
    public function needsRehash(string $encoded): bool
    {
        // TODO: Implement needsRehash() method.
    }

    /**
     * @return Collection|UserEnergyValuesCreation[]
     */
    public function getStrengths(): Collection
    {
        return $this->strengths;
    }

    public function addStrength(UserEnergyValuesCreation $strength): self
    {
        if (!$this->strengths->contains($strength)) {
            $this->strengths[] = $strength;
            $strength->setUserId($this);
        }

        return $this;
    }

    public function removeStrength(UserEnergyValuesCreation $strength): self
    {
        if ($this->strengths->contains($strength)) {
            $this->strengths->removeElement($strength);
            // set the owning side to null (unless already changed)
            if ($strength->getUserId() === $this) {
                $strength->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserActionPlanCreation[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(UserActionPlanCreation $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setUserActionsId($this);
        }

        return $this;
    }

    public function removeAction(UserActionPlanCreation $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            // set the owning side to null (unless already changed)
            if ($action->getUserActionsId() === $this) {
                $action->setUserActionsId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserObjectiveCreation[]
     */
    public function getObjectives(): Collection
    {
        return $this->objectives;
    }

    public function addObjective(UserObjectiveCreation $objective): self
    {
        if (!$this->objectives->contains($objective)) {
            $this->objectives[] = $objective;
            $objective->setUserObjectiveId($this);
        }

        return $this;
    }

    public function removeObjective(UserObjectiveCreation $objective): self
    {
        if ($this->objectives->contains($objective)) {
            $this->objectives->removeElement($objective);
            // set the owning side to null (unless already changed)
            if ($objective->getUserObjectiveId() === $this) {
                $objective->setUserObjectiveId(null);
            }
        }

        return $this;
    }
}
