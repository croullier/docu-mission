<?php



use Doctrine\Mapping as ORM;

/**
 * Utilisateur
 *
 * @Table(name="utilisateur")
 * @Entity
 */
class Utilisateur
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
     * @Column(name="login", type="string", length=30, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @Column(name="password", type="string", length=15, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @Column(name="nom", type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @Column(name="prenom", type="string", length=30, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var \Groupe
     *
     * @ManyToOne(targetEntity="Groupe")
     *   @JoinColumn(name="idGroupe", referencedColumnName="id")
     * 
     */
    private $groupe;

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
     * Set login
     *
     * @param string $login
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Utilisateur
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set idgroupe
     *
     * @param \Groupe $idgroupe
     * @return Utilisateur
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;
    
        return $this;
    }

    /**
     * Get idgroupe
     *
     * @return \Groupe 
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set idmonde
     *
     * @param \Monde $idmonde
     * @return Utilisateur
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
