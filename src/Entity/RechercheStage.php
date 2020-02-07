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
    private $btsStage;

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
    public function getBTSStage(): ?string 
    {
        return $this->btsStage;
    }

    /**
     * @param string|null $btsStage
     * @return RechercheStage
     */
    public function setBTSStage(?string $btsStage): RechercheStage
    {
        $this->btsStage = $btsStage;
        return $this;
    }

}