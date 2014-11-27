<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity
 */
class Theme
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
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var \Domaine
     *
     * @ORM\ManyToOne(targetEntity="Domaine")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDomaine", referencedColumnName="id")
     * })
     */
    private $iddomaine;

    /**
     * @var \Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idThemeParent", referencedColumnName="id")
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
