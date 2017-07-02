<?php
/**
 * Created by PhpStorm.
 * User: Seynabou SARR
 * Date: 29/06/2017
 * Time: 21:04
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bonobo")
 */
class Bonobo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id_bonobo;

    /**
     * @ORM\Column(type="string", length=50)
     */
    public $nom;
    /**
     * @ORM\Column(type="integer")
     */
    public $age;
    /**
     * @ORM\Column(type="string", length=50)
     */
    public $nourriture;
    /**
     * @ORM\Column(type="string", length=50)
     */
    public $famille ;
    /**
     * @ORM\Column(type="string", length=50)
     */
    public $race;



     
     //* @ORM\JoinColumn(name="category_id", referencedColumnName="id")
    


    public function setNom($nom)
    {
        $this->nom=$nom;
    }
    
    public function setAge($age)
    {
        $this->age=$age;
    }

    public function setNourriture($nourriture)
    {
        $this->nourriture=$nourriture;
    }

    public function setFamille($famille)
    {
        $this->famille=$famille;
    }


    public function setRace($race)
    {
        $this->race=$race;


    }


    public function __construct($nom,$age,$nourriture,$famille,$race)
    {
        $this->nom=$nom;
        $this->age=$age;
        $this->nourriture=$nourriture;
        $this->famille=$famille;
        $this->race=$race;
    }






    /*public function getNom()
    {
        return $this->nom;
    }
    
    public function getAge()
    {
        return $this->age;
    }

    public function getNourriture()
    {
        return $this->nourriture;
    }

    public function getFamille()
    {
        return $this->id_famille;
    }


    public function getRace()
    {
       return $this->id_race;

    }*/
}