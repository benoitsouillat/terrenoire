<?php

namespace App\Controller;

use App\Entity\Dog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/ourdog/{id}", name="dog_info")
     * 
     */
    public function ourdog(EntityManagerInterface $manager, Request $request): Response
    {

        dump($request);

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
        return $this->render('dog/puppies.html.twig');
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

    /**
     * @Route ("/admin", name="admin")
     */
    public function admin(Request $request): Response
    {
        $repo = $this->getDoctrine()->getRepository(Dog::class);
        $dogs = $repo->findAll();

        return $this->render('dog/admin.html.twig', [
            'dogs' => $dogs
        ]);
    }

    /**
     * @Route("/create_dog", name="create_dog")
     * @Route("/manage_dog/{id}", name="manage_dog")
     */
    public function manageDog(Dog $dog = null, Request $request) {

        if (!$dog){
            $dog = new Dog();
        }
        $manager = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($dog)
                ->add('name')
                ->add('birth', DateType::class, [
                    'widget' => 'single_text',
                    'html5' => true,
                ] )
                ->add('breed', ChoiceType::class, [
                    'choices' => [
                        'Cane Corso' => 'Cane Corso',
                        'Teckel' => 'Teckel',
                        'Whippet' => 'Whippet',
                    ],
                ])
                ->add('breeder', ChoiceType::class, [
                    'choices' => [
                        'Le Temple de Jade' => 'du Temple de Jade',
                        'Le Domaine des Terres Noires' => 'du Domaine des Terres Noires',
                        'La Romance des Damoiseaux' => 'de la Romance des Damoiseaux',
                        'Corso Di Munteanu' => 'di Corso di Munteanu'
                    ]
                ])
                ->add('sex')
                ->add('lof')
                ->add('puce')
                ->add('imageFile', FileType::class)
                ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($dog);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('dog/admin_form.html.twig', [
            'formDog' => $form->createView(),
            'form_action' => 'Valider le chien',
        ]);
    }

    /**
     * @Route("/manage_dog", name="update_dog")
     */
    public function updateDog(Dog $dog = null, Request $request) {


        $repo = $this->getDoctrine()->getRepository(Dog::class);
        $dogs = $repo->findAll();
        $manager = $this->getDoctrine()->getManager();

        $chooseDogForm = $this->createFormBuilder($dog)
                    ->add('id', EntityType::class, [
                        'class' => Dog::class,
                        'choice_label' => function($dogs) {
                            return $dogs->getName();
                        }
                    ])
                    ->getForm();


        $chooseDogForm->handleRequest($request);

        if($chooseDogForm->isSubmitted())
        {
            $result = $_POST['form']['id'];
            return $this->redirectToRoute('manage_dog', [
                'id' => $result,
            ]);

        }


        return $this->render('dog/admin_form.html.twig', [
            'chooseDog' => $chooseDogForm->createView(),
            'form_action' => 'Modifier un chien',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_dog")
     * 
     */
    public function delete(Dog $dog):Response {

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($dog);
        $manager->flush();

        return $this->redirectToRoute('admin', [
            'deleteDog' => 'Le chien a bien été supprimé ! ',
        ]);
    }


}
