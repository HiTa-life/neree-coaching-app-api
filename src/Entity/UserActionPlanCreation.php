<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserActionPlanCreationRepository")
 */
class UserActionPlanCreation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $title_action;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $positive_objective;

    /**
     * @ORM\Column(type="date")
     */
    private $beginning_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $efficience_action;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $expected_result;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $specific_action;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $mesurable_action;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $motivating_action;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ecological_action;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $positive_action;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $realizable_action;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $resources;


    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $obstacles;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $deflect_obstacles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserObjectiveCreation", mappedBy="title_action_objective")
     */
    private $userObjectiveCreations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserAccountCreation", inversedBy="actions")
     */
    private $user_actions_id;


    public function __construct()
    {
        $this->userObjectiveCreations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getTitleAction(): ?string
    {
        return $this->title_action;
    }

    public function setTitleAction(?string $title_action): self
    {
        $this->title_action = $title_action;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPositiveObjective(): ?string
    {
        return $this->positive_objective;
    }

    public function setPositiveObjective(?string $positive_objective): self
    {
        $this->positive_objective = $positive_objective;

        return $this;
    }

    public function getBeginningDate(): ?\DateTimeInterface
    {
        return $this->beginning_date;
    }

    public function setBeginningDate(\DateTimeInterface $beginning_date): self
    {
        $this->beginning_date = $beginning_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getEfficienceAction(): ?string
    {
        return $this->efficience_action;
    }

    public function setEfficienceAction(?string $efficience_action): self
    {
        $this->efficience_action = $efficience_action;

        return $this;
    }

    public function getExpectedResult(): ?string
    {
        return $this->expected_result;
    }

    public function setExpectedResult(?string $expected_result): self
    {
        $this->expected_result = $expected_result;

        return $this;
    }

    public function getSpecificAction(): ?bool
    {
        return $this->specific_action;
    }

    public function setSpecificAction(?bool $specific_action): self
    {
        $this->specific_action = $specific_action;

        return $this;
    }

    public function getMesurableAction(): ?bool
    {
        return $this->mesurable_action;
    }

    public function setMesurableAction(?bool $mesurable_action): self
    {
        $this->mesurable_action = $mesurable_action;

        return $this;
    }

    public function getMotivatingAction(): ?bool
    {
        return $this->motivating_action;
    }

    public function setMotivatingAction(?bool $motivating_action): self
    {
        $this->motivating_action = $motivating_action;

        return $this;
    }

    public function getEcologicalAction(): ?bool
    {
        return $this->ecological_action;
    }

    public function setEcologicalAction(?bool $ecological_action): self
    {
        $this->ecological_action = $ecological_action;

        return $this;
    }

    public function getPositiveAction(): ?bool
    {
        return $this->positive_action;
    }

    public function setPositiveAction(?bool $positive_action): self
    {
        $this->positive_action = $positive_action;

        return $this;
    }

    public function getRealizableAction(): ?bool
    {
        return $this->realizable_action;
    }

    public function setRealizableAction(?bool $realizable_action): self
    {
        $this->realizable_action = $realizable_action;

        return $this;
    }

    public function getResources(): ?string
    {
        return $this->resources;
    }

    public function setResources(?string $resources): self
    {
        $this->resources = $resources;

        return $this;
    }


    public function getObstacles(): ?string
    {
        return $this->obstacles;
    }

    public function setObstacles(?string $obstacles): self
    {
        $this->obstacles = $obstacles;

        return $this;
    }

    public function getDeflectObstacles(): ?string
    {
        return $this->deflect_obstacles;
    }

    public function setDeflectObstacles(?string $deflect_obstacles): self
    {
        $this->deflect_obstacles = $deflect_obstacles;

        return $this;
    }

//    /**
//     * @return Collection|UserObjectiveCreation[]
//     */
//    public function getUserObjectiveCreations(): Collection
//    {
//        return $this->userObjectiveCreations;
//    }
//
//    public function addUserObjectiveCreation(UserObjectiveCreation $userObjectiveCreation): self
//    {
//        if (!$this->userObjectiveCreations->contains($userObjectiveCreation)) {
//            $this->userObjectiveCreations[] = $userObjectiveCreation;
//            $userObjectiveCreation->setTitleAction($this);
//        }
//
//        return $this;
//    }
//
//    public function removeUserObjectiveCreation(UserObjectiveCreation $userObjectiveCreation): self
//    {
//        if ($this->userObjectiveCreations->contains($userObjectiveCreation)) {
//            $this->userObjectiveCreations->removeElement($userObjectiveCreation);
//            // set the owning side to null (unless already changed)
//            if ($userObjectiveCreation->getTitleActionObjective() === $this) {
//                $userObjectiveCreation->setTitleActionObjective(null);
//            }
//        }
//
//        return $this;
//    }

    public function getUserActionsId(): ?UserAccountCreation
    {
        return $this->user_actions_id;
    }

    public function setUserActionsId(?UserAccountCreation $user_actions_id): self
    {
        $this->user_actions_id = $user_actions_id;

        return $this;
    }

}
