<?php



use Doctrine\Mapping as ORM;

/**
 * Domaine
 *
 * @Table(name="domaine")
 * @Entity
 */
class Domaine
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
     * @Column(name="libelle", type="string", length=50, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Monde
     *
     * @ManyToOne(targetEntity="Monde")
     * @JoinColumns({
     *   @JoinColumn(name="idMonde", referencedColumnName="id")
     * })
     */
    private $idmonde;


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
     * @return Domaine
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
     * Set description
     *
     * @param string $description
     * @return Domaine
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set idmonde
     *
     * @param \Monde $idmonde
     * @return Domaine
     */
    public function setIdmonde(\Monde $idmonde = null)
    {
        $this->idmonde = $idmonde;
    
        return $this;
    }

    /**
     * Get idmonde
     *
     * @return \Monde 
     */
    public function getIdmonde()
    {
        return $this->idmonde;
    }
}
