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
    private $departementEntreprise;

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
    public function getDepartementEntreprise(): ?string 
    {
        return $this->departementEntreprise;
    }

    /**
     * @param string|null $departementEntreprise
     * @return RechercheEntreprise
     */
    public function setDepartementEntreprise(?string $departementEntreprise): RechercheEntreprise
    {
        $this->departementEntreprise = $departementEntreprise;
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