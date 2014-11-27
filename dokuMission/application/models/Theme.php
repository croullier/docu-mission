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
     *   @JoinColumn(name="idDomaine", referencedColumnName="id")
     * })
     */
    private $iddomaine;

    /**
     * @var \Theme
     *
     * @ManyToOne(targetEntity="Theme")
     * @JoinColumns({
     *   @JoinColumn(name="idThemeParent", referencedColumnName="id")
     * })
     */
    private $idthemeparent;


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
     * Set iddomaine
     *
     * @param \Domaine $iddomaine
     * @return Theme
     */
    public function setIddomaine(\Domaine $iddomaine = null)
    {
        $this->iddomaine = $iddomaine;
    
        return $this;
    }

    /**
     * Get iddomaine
     *
     * @return \Domaine 
     */
    public function getIddomaine()
    {
        return $this->iddomaine;
    }

    /**
     * Set idthemeparent
     *
     * @param \Theme $idthemeparent
     * @return Theme
     */
    public function setIdthemeparent(\Theme $idthemeparent = null)
    {
        $this->idthemeparent = $idthemeparent;
    
        return $this;
    }

    /**
     * Get idthemeparent
     *
     * @return \Theme 
     */
    public function getIdthemeparent()
    {
        return $this->idthemeparent;
    }
}
