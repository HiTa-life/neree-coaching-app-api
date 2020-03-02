<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserEnergyValuesCreationRepository")
 */
class UserEnergyValuesCreation
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
    private $strength_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $actually_notation;

    /**
     * @ORM\Column(type="integer")
     */
    private $expected_notation;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $action_one;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $action_two;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $action_three;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $action_four;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $action_five;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserObjectiveCreation", mappedBy="strength_name")
     */
    private $title_action_objective;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserAccountCreation", inversedBy="strengths")
     */
    private $user_id;

    public function __construct()
    {
        $this->title_action_objective = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrengthName(): ?string
    {
        return $this->strength_name;
    }

    public function setStrengthName(string $strength_name): self
    {
        $this->strength_name = $strength_name;

        return $this;
    }

    public function getActuallyNotation(): ?int
    {
        return $this->actually_notation;
    }

    public function setActuallyNotation(int $actually_notation): self
    {
        $this->actually_notation = $actually_notation;

        return $this;
    }

    public function getExpectedNotation(): ?int
    {
        return $this->expected_notation;
    }

    public function setExpectedNotation(int $expected_notation): self
    {
        $this->expected_notation = $expected_notation;

        return $this;
    }

    public function getActionOne(): ?string
    {
        return $this->action_one;
    }

    public function setActionOne(string $action_one): self
    {
        $this->action_one = $action_one;

        return $this;
    }

    public function getActionTwo(): ?string
    {
        return $this->action_two;
    }

    public function setActionTwo(?string $action_two): self
    {
        $this->action_two = $action_two;

        return $this;
    }

    public function getActionThree(): ?string
    {
        return $this->action_three;
    }

    public function setActionThree(?string $action_three): self
    {
        $this->action_three = $action_three;

        return $this;
    }

    public function getActionFour(): ?string
    {
        return $this->action_four;
    }

    public function setActionFour(?string $action_four): self
    {
        $this->action_four = $action_four;

        return $this;
    }

    public function getActionFive(): ?string
    {
        return $this->action_five;
    }

    public function setActionFive(?string $action_five): self
    {
        $this->action_five = $action_five;

        return $this;
    }

    /**
     * @return Collection|UserObjectiveCreation[]
     */
    public function getTitleActionObjective(): Collection
    {
        return $this->title_action_objective;
    }

    public function addTitleActionObjective(UserObjectiveCreation $titleActionObjective): self
    {
        if (!$this->title_action_objective->contains($titleActionObjective)) {
            $this->title_action_objective[] = $titleActionObjective;
            $titleActionObjective->setStrengthName($this);
        }

        return $this;
    }

    public function removeTitleActionObjective(UserObjectiveCreation $titleActionObjective): self
    {
        if ($this->title_action_objective->contains($titleActionObjective)) {
            $this->title_action_objective->removeElement($titleActionObjective);
            // set the owning side to null (unless already changed)
            if ($titleActionObjective->getStrengthName() === $this) {
                $titleActionObjective->setStrengthName(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?UserAccountCreation
    {
        return $this->user_id;
    }

    public function setUserId(?UserAccountCreation $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
