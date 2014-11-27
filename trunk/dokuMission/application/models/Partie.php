<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Partie
 *
 * @ORM\Table(name="partie")
 * @ORM\Entity
 */
class Partie
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
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="smallint", nullable=true)
     */
    private $ordre;

    /**
     * @var integer
     *
     * @ORM\Column(name="niveau", type="smallint", nullable=true)
     */
    private $niveau;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Version", mappedBy="idpartie")
     */
    private $idversion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idversion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add idversion
     *
     * @param \Version $idversion
     * @return Partie
     */
    public function addIdversion(\Version $idversion)
    {
        $this->idversion[] = $idversion;
    
        return $this;
    }

    /**
     * Remove idversion
     *
     * @param \Version $idversion
     */
    public function removeIdversion(\Version $idversion)
    {
        $this->idversion->removeElement($idversion);
    }

    /**
     * Get idversion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdversion()
    {
        return $this->idversion;
    }
}
