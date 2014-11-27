<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Version
 *
 * @ORM\Table(name="version")
 * @ORM\Entity
 */
class Version
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateMaj", type="datetime", nullable=true)
     */
    private $datemaj;

    /**
     * @var \Document
     *
     * @ORM\ManyToOne(targetEntity="Document")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDocument", referencedColumnName="id")
     * })
     */
    private $iddocument;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAuteur", referencedColumnName="id")
     * })
     */
    private $idauteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Partie", inversedBy="idversion")
     * @ORM\JoinTable(name="partieversion",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idVersion", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idPartie", referencedColumnName="id")
     *   }
     * )
     */
    private $idpartie;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idpartie = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set datemaj
     *
     * @param \DateTime $datemaj
     * @return Version
     */
    public function setDatemaj($datemaj)
    {
        $this->datemaj = $datemaj;
    
        return $this;
    }

    /**
     * Get datemaj
     *
     * @return \DateTime 
     */
    public function getDatemaj()
    {
        return $this->datemaj;
    }

    /**
     * Set iddocument
     *
     * @param \Document $iddocument
     * @return Version
     */
    public function setIddocument(\Document $iddocument = null)
    {
        $this->iddocument = $iddocument;
    
        return $this;
    }

    /**
     * Get iddocument
     *
     * @return \Document 
     */
    public function getIddocument()
    {
        return $this->iddocument;
    }

    /**
     * Set idauteur
     *
     * @param \Utilisateur $idauteur
     * @return Version
     */
    public function setIdauteur(\Utilisateur $idauteur = null)
    {
        $this->idauteur = $idauteur;
    
        return $this;
    }

    /**
     * Get idauteur
     *
     * @return \Utilisateur 
     */
    public function getIdauteur()
    {
        return $this->idauteur;
    }

    /**
     * Add idpartie
     *
     * @param \Partie $idpartie
     * @return Version
     */
    public function addIdpartie(\Partie $idpartie)
    {
        $this->idpartie[] = $idpartie;
    
        return $this;
    }

    /**
     * Remove idpartie
     *
     * @param \Partie $idpartie
     */
    public function removeIdpartie(\Partie $idpartie)
    {
        $this->idpartie->removeElement($idpartie);
    }

    /**
     * Get idpartie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdpartie()
    {
        return $this->idpartie;
    }
}
