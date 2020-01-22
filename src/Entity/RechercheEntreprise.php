<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class RechercheEntreprise {

    /**
     * @var string|null
     */
    private $nomEntreprise;

    /**
     * @var string|null
     */
    private $regionEntreprise;

    /**
     * @var string|null
     */
    private $villeEntreprise;

    /**
     * @return string|null
     */
    public function getNomEntreprise(): ?string 
    {
        return $this->nomEntreprise;
    }

    /**
     * @param string|null $nomEntreprise
     * @return RechercheEntreprise
     */
    public function setNomEntreprise(?string $nomEntreprise): RechercheEntreprise
    {
        $this->nomEntreprise = $nomEntreprise;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegionEntreprise(): ?string 
    {
        return $this->regionEntreprise;
    }

    /**
     * @param string|null $regionEntreprise
     * @return RechercheEntreprise
     */
    public function setRegionEntreprise(?string $regionEntreprise): RechercheEntreprise
    {
        $this->regionEntreprise = $regionEntreprise;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVilleEntreprise(): ?string 
    {
        return $this->villeEntreprise;
    }

    /**
     * @param string|null $villeEntreprise
     * @return RechercheEntreprise
     */
    public function setVilleEntreprise(?string $villeEntreprise): RechercheEntreprise
    {
        $this->villeEntreprise = $villeEntreprise;
        return $this;
    }

}