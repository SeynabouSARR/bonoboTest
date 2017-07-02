<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Race;
use AppBundle\Entity\Bonobo;
use AppBundle\Entity\Amis;
use AppBundle\Entity\User;




class DefaultController extends Controller
{
    


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);*/
        $reponse='
        <input id="login" placeholder="user" />
        <br/>
        <input id="password" type="password" placeholder="Mot de passe" />
        <br/>
        <input  type="button" value="VALIDER"  onclick="connecter()"/>

        <script>
        function connecter()
        {
            var login=document.getElementById("login").value;
            var password=document.getElementById("password").value;
            
            window.location.href = "/connecter/"+login+"/"+password;
        }

        </script>

        ';
        $response = new Response($reponse, Response::HTTP_OK);
        return $response; 
    }





    /**
     * @Route("/connecter/{login}/{password}", name="connecter")
     */
    public function connecterAction($login,$password)
    {
        //$connexion=$this->getDoctrine()->getManager();
        
        /*$user=$connexion->getRepository('AppBundle:User')->findBy(array(
                 'login' =>$login ,
                 'password' =>$password 
                )
        );*/
        //print_r($user);

           
       
        return $this->redirectToRoute('liste');
          
    }




     /**
     * @Route("/ajouter/{name}/{age}/{race}/{food}/{family}", name="ajouter")
     */
    public function ajouterAction($name,$age,$race,$food,$family)
    {
        $connexion=$this->getDoctrine()->getManager();
        $bonobo=new Bonobo($name,$age,$food,$family,$race);
        //$response = new Response(" ", Response::HTTP_OK);


        $connexion->persist($bonobo);
        $connexion->flush();
        return $this->redirectToRoute('liste');
          
    }




     /**
     * @Route("/ajouterAmi/{id_bonobo}/{id_son_ami}", name="ajouterAmi")
     */
    public function ajouterAmiAction($id_bonobo,$id_son_ami)
    {
        $connexion=$this->getDoctrine()->getManager();
        $amis=new Amis($id_bonobo,$id_son_ami);
        echo $amis->id_bonobo;
        
        if($id_bonobo!=$id_son_ami)
        {
            $connexion->persist($amis);
            $connexion->flush();
        }
        
        return $this->redirectToRoute('liste');
       
         
    }



    /**
     * @Route("/updateDB/{id}/{name}/{age}/{race}/{food}/{family}", name="updateDB")
     */
    public function updateDBAction($id,$name,$age,$race,$food,$family)
    {
        $connexion=$this->getDoctrine()->getManager();
        $bonobo=$connexion->getRepository('AppBundle:Bonobo')->find($id);

        //Modification du Bonobo
        $bonobo->nom=$name;
        $bonobo->age=$age;
        $bonobo->nourriture=$food;
        $bonobo->famille=$family;
        $bonobo->race=$race;

        //Modification du Bonobo dans la base de données
        $connexion->flush();
        return $this->redirectToRoute('liste');
          
    }



    /**
     * @Route("/delete2Amis/{id}", name="delete2Amis")
     */
    //public function detailsAction(Request $request)
    public function delete2AmisAction($id)
    {
            //$reponse="print_r($request)";
            $connexion=$this->getDoctrine()->getManager();
            $amis=$connexion->getRepository('AppBundle:Amis')->find($id);
            $connexion->remove($amis);
            $connexion->flush();
            return $this->redirectToRoute('liste');
           
    }


    /**
     * @Route("/deleteAmis/{id_bonobo}/{id_son_ami}", name="deleteAmis")
     */
    //public function detailsAction(Request $request)
    public function deleteAmisAction($id_bonobo,$id_son_ami)
    {
            //$reponse="print_r($request)";
            $connexion=$this->getDoctrine()->getManager();
            $amis=$connexion->getRepository('AppBundle:Amis')->findBy(array(
                 'id_bonobo' =>$id_bonobo ,
                 'id_son_ami' =>$id_son_ami 
                )
            );
            //print_r($amis);

            $connexion->remove($amis[0]);
            $connexion->flush();
            return $this->redirectToRoute('liste');
           
    }



    



    /**
     * @Route("/liste", name="liste")
     */
    public function listeAction(Request $request)
    {

        $connexion=$this->getDoctrine()->getManager();
        $bonobos_bdd=$connexion->getRepository('AppBundle:Bonobo')->findAll();

        $bonobos = array();

        foreach($bonobos_bdd as $bonobo_bdd)
        {
            $tabs = array(
                'id_bonobo' => $bonobo_bdd->id_bonobo,
                'nom' => $bonobo_bdd->nom,
                'age' => $bonobo_bdd->age,
                'famille' => $bonobo_bdd->famille,
                'race' => $bonobo_bdd->race
            );

            array_push($bonobos,$tabs);
           // $posts = $user->getPosts();
        }


        $reponse="";

        $reponse="<table>";
        $reponse.="<tr><th>Nom</th> <th>Age</th> <th>Famille</th> <th>Race</th> <th></th> </tr>";
        foreach ($bonobos as $bonobo)
        {
            $reponse.="<tr><td>".$bonobo['nom']."</td>";
            $reponse.="<td>".$bonobo['age']."</td>";
            $reponse.="<td>".$bonobo['famille']."</td>";
            $reponse.="<td>".$bonobo['race']."</td>";
            $reponse.="<td>"; 
            $reponse.='<a href="details/'.$bonobo['id_bonobo'].'" >Afficher</a> ';
            $reponse.='<a href="update/'.$bonobo['id_bonobo'].'" >Modifier</a> ';
            $reponse.='<a href="delete/'.$bonobo['id_bonobo'].'" >Supprimer</a> ';
            $reponse.='<a href="definirAmi/'.$bonobo['id_bonobo'].'" >Definir ami</a> ';
            $reponse.="</td></tr>";
        }

        $reponse.="</table>";
        $reponse.="<hr/>";
        $reponse.="Ajout d'un nouveau Bonobo<br/>";
        $reponse.='<input id="nom" placeholder="Nom"  /><br/>';
        $reponse.='<input id="age" type="number" placeholder="Age" value="0" /><br/>';
        $reponse.='<input id="race" placeholder="Race"  /><br/>';
        $reponse.='<input id="nouriture" placeholder="Nouriture"  /><br/>';
        $reponse.='<input id="famille" placeholder="Famille"  /><br/>';
        $reponse.='<input type="button" id="bouton_ajouter" value="Ajouter" onclick="enregistrer()"  /><br/>';
        $reponse.='
        <script>
        function enregistrer()
        {
            var nom=document.getElementById("nom").value;
            var age=document.getElementById("age").value;
            var race=document.getElementById("race").value;
            var nouriture=document.getElementById("nouriture").value;
            var famille=document.getElementById("famille").value;
            
            //alert(\'dans la fonction\'+nom.value+);
            window.location.href = "/ajouter/"+nom+"/"+age+"/"+race+"/"+nouriture+"/"+famille;
        }
        </script>
        ';

        
        // create a simple Response with a 200 status code (the default)
        $response = new Response($reponse, Response::HTTP_OK);

        return $response; 
    }








    /**
     * @Route("/definirAmi/{id}", name="definirAmi")
     */
    public function definirAmiAction($id)
    {

        $connexion=$this->getDoctrine()->getManager();
        $amis=$connexion->getRepository('AppBundle:Amis')->findBy(array('id_bonobo' => $id));
        $liste_amis = array();
        $reponse="";

        foreach($amis as $ami)
        {
            array_push($liste_amis,$ami->id_son_ami);
           // $posts = $user->getPosts();
        }

        array_push($liste_amis,$id);
        

        $bonobos_bdd=$connexion->getRepository('AppBundle:Bonobo')->findAll();

        $bonobos = array();

        
        $reponse="<table>";
        $reponse.="<tr><th>Nom</th> <th>Age</th> <th>Famille</th> <th>Race</th> <th></th> </tr>";
        foreach ($bonobos_bdd as $bonobo)
        {
            echo $bonobo->id_bonobo.'/'.array_search($bonobo->id_bonobo, $liste_amis).'/'.!array_search($bonobo->id_bonobo, $liste_amis).'#';
            if(!is_numeric(array_search($bonobo->id_bonobo, $liste_amis)))
            {
                echo $bonobo->id_bonobo.'/'.array_search($bonobo->id_bonobo, $liste_amis).'#';
                $reponse.="<tr><td>".$bonobo->nom."</td>";
                $reponse.="<td>".$bonobo->age."</td>";
                $reponse.="<td>".$bonobo->famille."</td>";
                $reponse.="<td>".$bonobo->race."</td>";
                $reponse.="<td>"; 
                $reponse.='<a href="/ajouterAmi/'.$id.'/'.$bonobo->id_bonobo.'" >Definir comme ami</a> ';
                
                $reponse.="</td></tr>";
            }
        }
        
        // create a simple Response with a 200 status code (the default)*/
        $response = new Response($reponse, Response::HTTP_OK);
        return $response; 
    }




    /**
     * @Route("/details/{id}", name="details")
     */
    //public function detailsAction(Request $request)
    public function detailsAction($id)
    {   
         $connexion=$this->getDoctrine()->getManager();
         $bonobo=$connexion->getRepository('AppBundle:Bonobo')->find($id);
         
        $reponse="";

            
        $reponse="<table>";
        $reponse.="<tr><td> Nom : </td> <td>$bonobo->nom</td> </tr>";
        $reponse.="<tr><td>Age</td> <td>$bonobo->age</td> </tr>";
        $reponse.="<tr><td>Famille</td> <td>$bonobo->famille</td> </tr>";
        $reponse.="<tr><td>Race</td> <td>$bonobo->race</td> </tr>";
        $reponse.="<tr><td>Nourriture</td> <td>$bonobo->nourriture</td> </tr>";
        $reponse.="</table>";

        $reponse.="<hr/>";
        $reponse.="Les amis";

       // $amis=$connexion->getRepository('AppBundle:Amis')->findBy(array('id_bonobo' => $id));
        $amis=$connexion->getRepository('AppBundle:Amis')->findBy(array('id_bonobo' => $id));

       
        $bonobos = array();
        
        foreach ($amis as $ami) {

            $amis_info=$connexion->getRepository('AppBundle:Bonobo')->findBy(array('id_bonobo' => $ami->id_son_ami));
            array_push($bonobos,$amis_info);
        }



        $reponse.="<table>";
        $reponse.="<tr><th>Nom</th> <th>Age</th> <th>Famille</th> <th>Race</th> <th></th> </tr>";
        foreach ($bonobos as $bonobo)
        {
            $bonobo=$bonobo[0];
            $reponse.="<tr><td>".$bonobo->nom."</td>";
            $reponse.="<td>".$bonobo->age."</td>";
            $reponse.="<td>".$bonobo->famille."</td>";
            $reponse.="<td>".$bonobo->race."</td>";
            $reponse.="<td>"; 
            $reponse.='<a href="/details/'.$bonobo->id_bonobo.'" >Afficher</a> ';
            $reponse.='<a href="/deleteAmis/'.$id.'/'.$bonobo->id_bonobo.'" >Supprimer</a> ';
            $reponse.="</td></tr>";
        }

        $reponse.="</table>";
       
        // create a simple Response with a 200 status code (the default)
        //$response = new Response($reponse, Response::HTTP_OK);

        //return $response; 

       /* $con=$this->getDoctrine()->getManager();

            $r=new Race();
            $r->setLibelle("Blanc");
            $con->persist($r);
            $con->flush();
            //$reponse="print_r($request)";
            //$reponse=$id."";
            */
       
            $response = new Response($reponse, Response::HTTP_OK);

        return $response; 
    }




    /**
     * @Route("/update/{id}", name="update")
     */
    //public function detailsAction(Request $request)
    public function updateAction($id)
    {
            //$reponse="print_r($request)";
        $reponse="";
        $connexion=$this->getDoctrine()->getManager();
        $bonobo=$connexion->getRepository('AppBundle:Bonobo')->find($id);
        

            $reponse.="Modification du Bonobo ".$bonobo->nom." <hr/>";
            $reponse.='<input id="nom" placeholder="Nom"  value="'.$bonobo->nom.'"/><br/>';
            $reponse.='<input id="age" type="number" placeholder="Age"   value="'.$bonobo->age.'" /><br/>';
            $reponse.='<input id="race" placeholder="Race"   value="'.$bonobo->race.'" /><br/>';
            $reponse.='<input id="nouriture" placeholder="Nouriture"   value="'.$bonobo->nourriture.'" /><br/>';
            $reponse.='<input id="famille" placeholder="Famille"   value="'.$bonobo->famille.'" /><br/>';
            
            $reponse.='<input type="button" id="bouton_ajouter" value="Valider" onclick="enregistrer()"  /><br/>';
            $reponse.='
            <script>
            function enregistrer()
            {
                
               var nom=document.getElementById("nom").value;
               var age=document.getElementById("age").value;
               var race=document.getElementById("race").value;
               var nouriture=document.getElementById("nouriture").value;
               var famille=document.getElementById("famille").value;
               window.location.href = "/updateDB/'.$id.'/"+nom+"/"+age+"/"+race+"/"+nouriture+"/"+famille;
                
            }
            </script>
            ';


        
        
        // create a simple Response with a 200 status code (the default)
        $response = new Response($reponse, Response::HTTP_OK);

        return $response; 
    }




    /**
     * @Route("/tout", name="tout")
     */
    //public function detailsAction(Request $request)
    public function toutAction()
    {
            $connexion=$this->getDoctrine()->getManager();
            $bonobos=$connexion->getRepository('AppBundle:Bonobo')->findAll();

            if (!$bonobos) {
                throw $this->createNotFoundException(
                    'No event found'
                );
            }


            return $this->render('default/bonobo.html.twig',
                array('bonobos' => $bonobos)
            );
            
    }





    /**
     * @Route("/delete/{id}", name="delete")
     */
    //public function detailsAction(Request $request)
    public function deleteAction($id)
    {
            //$reponse="print_r($request)";
            $connexion=$this->getDoctrine()->getManager();
            $bonobo=$connexion->getRepository('AppBundle:Bonobo')->find($id);
            $connexion->remove($bonobo);
            $connexion->flush();
            return $this->redirectToRoute('liste');
           
    }




    
}


