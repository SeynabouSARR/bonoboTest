<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="amis")
 */
class Amis
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id_amis;

    
    /**
     * @ORM\Column(type="integer")
     */
    public $id_bonobo;

    /**
     * @ORM\Column(type="integer")
     */
    public $id_son_ami;



    public function setId_amis($id_amis)
    {
        $this->id_amis=$id_amis;
    }


    public function setId_bonobo($id_bonobo)
    {
        $this->id_bonobo=$id_bonobo;
    }

    public function setId_son_ami($id_son_ami)
    {
            $this->id_son_ami=$id_son_ami;
    }


    
    public function __construct($id_moi,$id_ami) 
    {
        $this->id_bonobo=$id_moi;
        $this->id_son_ami=$id_ami;
    }

}
?>