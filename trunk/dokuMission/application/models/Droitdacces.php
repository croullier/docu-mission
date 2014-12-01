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
     *   @JoinColumn(name="theme_id", referencedColumnName="id", unique=true)
     * })
     */
    private $theme;

    /**
     * @var \Groupe
     *
     * @OneToOne(targetEntity="Groupe")
     * @JoinColumns({
     *   @JoinColumn(name="groupe_id", referencedColumnName="id", unique=true)
     * })
     */
    private $groupe;

    /**
     * @var \Droit
     *
     * @OneToOne(targetEntity="Droit")
     * @JoinColumns({
     *   @JoinColumn(name="droit_id", referencedColumnName="id", unique=true)
     * })
     */
    private $droit;


    /**
     * Set theme
     *
     * @param \Theme $theme
     * @return Droitdacces
     */
    public function setTheme(\Theme $theme = null)
    {
        $this->theme = $theme;
    
        return $this;
    }

    /**
     * Get theme
     *
     * @return \Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set groupe
     *
     * @param \Groupe $groupe
     * @return Droitdacces
     */
    public function setGroupe(\Groupe $groupe = null)
    {
        $this->groupe = $groupe;
    
        return $this;
    }

    /**
     * Get groupe
     *
     * @return \Groupe 
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set droit
     *
     * @param \Droit $droit
     * @return Droitdacces
     */
    public function setDroit(\Droit $droit = null)
    {
        $this->droit = $droit;
    
        return $this;
    }

    /**
     * Get droit
     *
     * @return \Droit 
     */
    public function getDroit()
    {
        return $this->droit;
    }
}
