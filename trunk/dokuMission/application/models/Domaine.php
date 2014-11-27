<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Domaine
 *
 * @ORM\Table(name="domaine")
 * @ORM\Entity
 */
class Domaine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=50, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Monde
     *
     * @ORM\ManyToOne(targetEntity="Monde")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMonde", referencedColumnName="id")
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
