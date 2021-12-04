<?php

namespace App\Controller;



use App\Entity\Dog;
use App\Entity\Puppy;
use App\Form\DogType;
use App\Entity\Litter;

use App\Form\PuppyType;
use App\Form\LitterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


    /**
     * @Route("/admin", name="admin_")
     */

    class AdminController extends AbstractController
    {

        /**
         * @Route("/", name="admin")
         */
        public function admin(Request $request):Response
        {
            return $this->render('admin/index.html.twig');
        }

        /**
         * @Route("/view_dog", name="view_dog")
         */
        public function viewDog() :Response
        {
            $repo = $this->getDoctrine()->getRepository(Dog::class);
            $dogs = $repo->findAll();

            return $this->render('admin/admin_dog.html.twig', [
                'dogs' => $dogs,
            ]);
        }

        /**
         * @Route("/create_dog", name="create_dog")
         * @Route("/manage_dog/{dog_id}", name="manage_dog")
         * @ParamConverter("dog", options={"id" = "dog_id"})
         */
        public function manageDog(EntityManagerInterface $manager, Dog $dog = null, Request $request) {

            if (!$dog){
                $dog = new Dog();
            }
            $form = $this->createForm(DogType::class, $dog);

            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $manager->persist($dog);
                $manager->flush();
                return $this->redirectToRoute('admin_view_dog');
            }
            return $this->render('admin/manage_dog.html.twig', [
                'formDog' => $form->createView(),
                'form_action' => 'Valider le chien',
            ]);
        }
         
        /**
         * @Route("/delete_dog/{dog_id}", name="delete_dog")
         * @ParamConverter("dog", options={"id" = "dog_id"})
         */
        public function delete(EntityManagerInterface $manager, Dog $dog):Response {

            $manager->remove($dog);
            $manager->flush();
    
            return $this->redirectToRoute('admin_view_dog');
        }

        /**
         * @Route("/view_litter", name="view_litter")
         */
        public function viewLitter()
        {
            $repo = $this->getDoctrine()->getRepository(Litter::class);
            $litters = $repo->findByBirthdate();
            /*$litters = $repo->findBy(
                [],                             // Criteria
                ['birthdate' => 'DESC'],        // Order By
                50,                             // Limit
            ); */

            return $this->render('admin/admin_litter.html.twig', [
                'litters' => $litters,
            ]);
        }

        /**
         * @Route("/create_litter", name="create_litter")
         * @Route("/manage_litter/{litter_id}", name="manage_litter")
         * @ParamConverter("litter", options={"id" = "litter_id"})
         */
        public function manageLitter(Litter $litter = null, Request $request, EntityManagerInterface $manager):Response
        {

            $repo = $this->getDoctrine()->getRepository(Dog::class);
            $dogs = $repo->findAll();

            $males = $repo->findBy(
                ['sex' => 'Mâle'],
            );
            $lices = $repo->findBy(
                ['sex' => 'Femelle']
            );
            if(!$litter){
                $litter = new Litter();
            }
            $form = $this->createForm(LitterType::class, $litter, [
                'males' => $males,
                'lices' => $lices,
            ]);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $manager->persist($litter);
                $manager->flush();
                return $this->redirectToRoute('admin_view_litter');
            }

            return $this->render('admin/manage_litter.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        /**
         * @Route("/delete_litter/{litter_id}", name="delete_litter")
         * @ParamConverter("litter", options={"id" = "litter_id"})
         */
        public function deleteLitter(Litter $litter, EntityManagerInterface $manager ):Response
        {

            $manager->remove($litter);
            $manager->flush();

            return $this->redirectToRoute('admin_view_litter');
        }


    }
?>