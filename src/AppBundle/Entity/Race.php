<?php 

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="race")
 */
class Race
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle_race;

    

    public function setLibelle($libelle)
    {
        $this->libelle_race=$libelle;
    }


    public function setId($id)
    {
        $this->id=$id;
    }
} 
?>