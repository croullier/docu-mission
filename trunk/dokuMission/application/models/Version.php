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
     *   @JoinColumn(name="document_id", referencedColumnName="id")
     * })
     */
    private $document;

    /**
     * @var \Utilisateur
     *
     * @ManyToOne(targetEntity="Utilisateur")
     * @JoinColumns({
     *   @JoinColumn(name="utilisateur_id", referencedColumnName="id")
     * })
     */
    private $utilisateur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Partie", inversedBy="version")
     * @JoinTable(name="partieversion",
     *   joinColumns={
     *     @JoinColumn(name="version_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="partie_id", referencedColumnName="id")
     *   }
     * )
     */
    private $partie;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->partie = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set document
     *
     * @param \Document $document
     * @return Version
     */
    public function setDocument(\Document $document = null)
    {
        $this->document = $document;
    
        return $this;
    }

    /**
     * Get document
     *
     * @return \Document 
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set utilisateur
     *
     * @param \Utilisateur $utilisateur
     * @return Version
     */
    public function setUtilisateur(\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Add partie
     *
     * @param \Partie $partie
     * @return Version
     */
    public function addPartie(\Partie $partie)
    {
        $this->partie[] = $partie;
    
        return $this;
    }

    /**
     * Remove partie
     *
     * @param \Partie $partie
     */
    public function removePartie(\Partie $partie)
    {
        $this->partie->removeElement($partie);
    }

    /**
     * Get partie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartie()
    {
        return $this->partie;
    }
}
