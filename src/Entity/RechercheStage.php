<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class RechercheStage {

    /**
     * @var string|null
     */
    private $dateStage;

    /**
     * @var string|null
     */
    private $eleveStage;

    /**
     * @var string|null
     */
    private $entrepriseStage;

    /**
     * @return string|null
     */
    public function getDateStage(): ?string 
    {
        return $this->dateStage;
    }

    /**
     * @param string|null $dateStage
     * @return RechercheStage
     */
    public function setDateStage(?string $dateStage): RechercheStage
    {
        $this->dateStage = $dateStage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEleveStage(): ?string 
    {
        return $this->eleveStage;
    }

    /**
     * @param string|null $eleveStage
     * @return RechercheStage
     */
    public function setEleveStage(?string $eleveStage): RechercheStage
    {
        $this->eleveStage = $eleveStage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntrepriseStage(): ?string 
    {
        return $this->entrepriseStage;
    }

    /**
     * @param string|null $entrepriseStage
     * @return RechercheStage
     */
    public function setEntrepriseStage(?string $entrepriseStage): RechercheStage
    {
        $this->entrepriseStage = $entrepriseStage;
        return $this;
    }

}