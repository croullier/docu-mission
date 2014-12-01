<?php



use Doctrine\Mapping as ORM;

/**
 * Theme
 *
 * @Table(name="theme")
 * @Entity
 */
class Theme
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var \Domaine
     *
     * @ManyToOne(targetEntity="Domaine")
     * @JoinColumns({
     *   @JoinColumn(name="domaine_id", referencedColumnName="id")
     * })
     */
    private $domaine;

    /**
     * @var \Theme
     *
     * @ManyToOne(targetEntity="Theme")
     * @JoinColumns({
     *   @JoinColumn(name="theme_id", referencedColumnName="id")
     * })
     */
    private $theme;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Theme
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set domaine
     *
     * @param \Domaine $domaine
     * @return Theme
     */
    public function setDomaine(\Domaine $domaine = null)
    {
        $this->domaine = $domaine;
    
        return $this;
    }

    /**
     * Get domaine
     *
     * @return \Domaine 
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * Set theme
     *
     * @param \Theme $theme
     * @return Theme
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
}
