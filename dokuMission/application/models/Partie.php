<?php



use Doctrine\Mapping as ORM;

/**
 * Partie
 *
 * @Table(name="partie")
 * @Entity
 */
class Partie
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
     * @var string
     *
     * @Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var integer
     *
     * @Column(name="ordre", type="smallint", nullable=true)
     */
    private $ordre;

    /**
     * @var integer
     *
     * @Column(name="niveau", type="smallint", nullable=true)
     */
    private $niveau;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Version", mappedBy="partie")
     */
    private $version;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->version = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return Partie
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
     * Set contenu
     *
     * @param string $contenu
     * @return Partie
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return Partie
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    
        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set niveau
     *
     * @param integer $niveau
     * @return Partie
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    
        return $this;
    }

    /**
     * Get niveau
     *
     * @return integer 
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Add version
     *
     * @param \Version $version
     * @return Partie
     */
    public function addVersion(\Version $version)
    {
        $this->version[] = $version;
    
        return $this;
    }

    /**
     * Remove version
     *
     * @param \Version $version
     */
    public function removeVersion(\Version $version)
    {
        $this->version->removeElement($version);
    }

    /**
     * Get version
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVersion()
    {
        return $this->version;
    }
}
