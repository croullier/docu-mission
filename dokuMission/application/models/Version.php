<?php



use Doctrine\Mapping as ORM;

/**
 * Version
 *
 * @Table(name="version")
 * @Entity
 */
class Version
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
     * @var \DateTime
     *
     * @Column(name="dateMaj", type="datetime", nullable=true)
     */
    private $datemaj;

    /**
     * @var \Document
     *
     * @ManyToOne(targetEntity="Document")
     * @JoinColumns({
     *   @JoinColumn(name="idDocument", referencedColumnName="id")
     * })
     */
    private $iddocument;

    /**
     * @var \Utilisateur
     *
     * @ManyToOne(targetEntity="Utilisateur")
     * @JoinColumns({
     *   @JoinColumn(name="idAuteur", referencedColumnName="id")
     * })
     */
    private $idauteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Partie", inversedBy="idversion")
     * @JoinTable(name="partieversion",
     *   joinColumns={
     *     @JoinColumn(name="idVersion", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="idPartie", referencedColumnName="id")
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
