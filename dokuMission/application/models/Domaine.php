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
     *   @JoinColumn(name="monde_id", referencedColumnName="id")
     * })
     */
    private $monde;


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
     * Set monde
     *
     * @param \Monde $monde
     * @return Domaine
     */
    public function setMonde(\Monde $monde = null)
    {
        $this->monde = $monde;
    
        return $this;
    }

    /**
     * Get monde
     *
     * @return \Monde 
     */
    public function getMonde()
    {
        return $this->monde;
    }
}
