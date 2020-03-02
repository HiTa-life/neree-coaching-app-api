<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserObjectiveCreationRepository")
 */
class UserObjectiveCreation
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
    private $objective_title;


    /**
     * @ORM\Column(type="date")
     */
    private $beginning_date;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\UserActionPlanCreation", inversedBy="userObjectiveCreations")
//     * @ORM\JoinColumn(nullable=false)
//     */
//    private $title_action_objective;

    /**
     * @ORM\Column(type="boolean")
     */
    private $understandable_objective;

    /**
     * @ORM\Column(type="boolean")
     */
    private $personal_objective;

    /**
     * @ORM\Column(type="boolean")
     */
    private $realizable_objective;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ambitious_objective;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mesurable_action;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ecological_action;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserAccountCreation", inversedBy="objectives")
     */
    private $user_objective_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjectiveTitle(): ?string
    {
        return $this->objective_title;
    }

    public function setObjectiveTitle(string $objective_title): self
    {
        $this->objective_title = $objective_title;

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


//    public function getTitleActionObjective(): ?UserActionPlanCreation
//    {
//        return $this->title_action_objective;
//    }
//
//    public function setTitleActionObjective(?UserActionPlanCreation $title_action_objective): self
//    {
//        $this->title_action_objective = $title_action_objective;
//
//        return $this;
//    }

    public function getUnderstandableObjective(): ?bool
    {
        return $this->understandable_objective;
    }

    public function setUnderstandableObjective(bool $understandable_objective): self
    {
        $this->understandable_objective = $understandable_objective;

        return $this;
    }

    public function getPersonalObjective(): ?bool
    {
        return $this->personal_objective;
    }

    public function setPersonalObjective(bool $personal_objective): self
    {
        $this->personal_objective = $personal_objective;

        return $this;
    }

    public function getRealizableObjective(): ?bool
    {
        return $this->realizable_objective;
    }

    public function setRealizableObjective(bool $realizable_objective): self
    {
        $this->realizable_objective = $realizable_objective;

        return $this;
    }

    public function getAmbitiousObjective(): ?bool
    {
        return $this->ambitious_objective;
    }

    public function setAmbitiousObjective(bool $ambitious_objective): self
    {
        $this->ambitious_objective = $ambitious_objective;

        return $this;
    }

    public function getMesurableAction(): ?bool
    {
        return $this->mesurable_action;
    }

    public function setMesurableAction(bool $mesurable_action): self
    {
        $this->mesurable_action = $mesurable_action;

        return $this;
    }

    public function getEcologicalAction(): ?bool
    {
        return $this->ecological_action;
    }

    public function setEcologicalAction(bool $ecological_action): self
    {
        $this->ecological_action = $ecological_action;

        return $this;
    }

    public function getUserObjectiveId(): ?UserAccountCreation
    {
        return $this->user_objective_id;
    }

    public function setUserObjectiveId(?UserAccountCreation $user_objective_id): self
    {
        $this->user_objective_id = $user_objective_id;

        return $this;
    }
}
