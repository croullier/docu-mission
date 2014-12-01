<?php



use Doctrine\Mapping as ORM;

/**
 * Document
 *
 * @Table(name="document")
 * @Entity
 */
class Document
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
     * @Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $datecreation;

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
     * Set titre
     *
     * @param string $titre
     * @return Document
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return Document
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;
    
        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime 
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set theme
     *
     * @param \Theme $theme
     * @return Document
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
