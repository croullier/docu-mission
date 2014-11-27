<?php



use Doctrine\Mapping as ORM;

/**
 * Droitdacces
 *
 * @Table(name="droitdacces")
 * @Entity
 */
class Droitdacces
{
    /**
     * @var \Theme
     *
     * @OneToOne(targetEntity="Theme")
     * @JoinColumns({
     *   @JoinColumn(name="idTheme", referencedColumnName="id", unique=true)
     * })
     */
    private $idtheme;

    /**
     * @var \Groupe
     *
     * @OneToOne(targetEntity="Groupe")
     * @JoinColumns({
     *   @JoinColumn(name="idGroupe", referencedColumnName="id", unique=true)
     * })
     */
    private $idgroupe;

    /**
     * @var \Droit
     *
     * @OneToOne(targetEntity="Droit")
     * @JoinColumns({
     *   @JoinColumn(name="idDroit", referencedColumnName="id", unique=true)
     * })
     */
    private $iddroit;


    /**
     * Set idtheme
     *
     * @param \Theme $idtheme
     * @return Droitdacces
     */
    public function setIdtheme(\Theme $idtheme = null)
    {
        $this->idtheme = $idtheme;
    
        return $this;
    }

    /**
     * Get idtheme
     *
     * @return \Theme 
     */
    public function getIdtheme()
    {
        return $this->idtheme;
    }

    /**
     * Set idgroupe
     *
     * @param \Groupe $idgroupe
     * @return Droitdacces
     */
    public function setIdgroupe(\Groupe $idgroupe = null)
    {
        $this->idgroupe = $idgroupe;
    
        return $this;
    }

    /**
     * Get idgroupe
     *
     * @return \Groupe 
     */
    public function getIdgroupe()
    {
        return $this->idgroupe;
    }

    /**
     * Set iddroit
     *
     * @param \Droit $iddroit
     * @return Droitdacces
     */
    public function setIddroit(\Droit $iddroit = null)
    {
        $this->iddroit = $iddroit;
    
        return $this;
    }

    /**
     * Get iddroit
     *
     * @return \Droit 
     */
    public function getIddroit()
    {
        return $this->iddroit;
    }
}
