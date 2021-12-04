<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Entity\Litter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface;

class DogController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('dog/index.html.twig', [
            'title' => 'DogController',
        ]);
    }
    /**
     * @Route("/ourdog", name="ourdog")
     * @Route("/ourdog/{id}", name="dog_info") // Evite les URLs foireuses 
     * 
     */
    public function ourdog(): Response
    {

        $repo = $this->getDoctrine()->getRepository(Dog::class);
        $dogs = $repo->findAll();

        return $this->render('dog/ourdog.html.twig', [
            'dogs' => $dogs,
        ]);
    }

    /**
     * @Route("/puppies", name="puppies")
     */
    public function puppies(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Litter::class);
        $litters = $repo->findByBirthdate();

        return $this->render('dog/puppies.html.twig', [
            'litters' => $litters,
        ]);
    }

    /**
     * @Route("/breed", name="breed")
     */
    public function breed(): Response
    {
        return $this->render('dog/breed.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('dog/contact.html.twig');
    }
        
    /**
     * @Route("/lof", name="lof")
     */
    public function lof(): Response
    {
        return $this->render('dog/lof.html.twig');
    }    

    /**
    * @Route("/standard", name="standard")
    */
   public function standard(): Response
   {
       return $this->render('dog/standard.html.twig');
   }

}
