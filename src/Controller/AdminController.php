<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trasa;
use App\Repository\TrasaRepository;
use App\Form\TrasaType;
use App\Entity\Kurs;
use App\Repository\KursRepository;
use App\Form\KursType;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;

use Symfony\Component\Validator\Constraints\DateTime;

class AdminController extends AbstractController

/**
* @Route("/admin", name="admin.")
*/

{
    /**
     * @Route("/", name="panel")
     */
    public function index()
    {
        return $this->render('admin/panel.html.twig', [
            
        ]);
    }

    /**
     * @Route("/trasy", name="trasy")
     */

     public function trasy(TrasaRepository $repo) {
        $trasy = $repo->findAll();

        return $this->render('admin/trasy.html.twig', [
            'trasy' => $trasy
        ]);
     }


     /**
     * @Route("/nowa_trasa", name="nowa_trasa")
     */

    public function nowaTrasa(Request $request) {
        $trasa = new Trasa();
        $form = $this->createForm(TrasaType::class, $trasa);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em-> persist($trasa);
            $em-> flush();

            return $this->redirect($this->generateUrl('admin.trasy'));
        }

        return $this->render('admin/trasa.html.twig', [
            'form' => $form->createView()
        ]);
     }

     /**
     * @Route("/trasa/{id}", name="trasa")
     */

    public function trasa($id, TrasaRepository $repo, Request $request) {
        $trasa = $repo->find($id);

        $form = $this->createForm(TrasaType::class, $trasa);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em-> persist($trasa);
            $em-> flush();

            return $this->redirect($this->generateUrl('admin.trasy'));
        }

        return $this->render('admin/trasa.html.twig', [
            'form' => $form->createView()
        ]);
     }

     /**
      * @Route("/kursy/{id}", name="kursy")
      */

    public function kursy($id, KursRepository $kursRepo, TrasaRepository $trasaRepo) {
        $trasa = $trasaRepo->find($id);
        $kursy = $kursRepo->findBy(array('trasa' => $id));
        return $this->render('admin/kursy.html.twig', [
            'trasa' => $trasa,
            'kursy' => $kursy
        ]);
    }

    /**
      * @Route("/nowy_kurs/{id}", name="nowy_kurs")
      */

      public function nowyKurs($id, TrasaRepository $trasaRepo, Request $request) {
        $trasa = $trasaRepo->find($id);
        
        $kurs = new Kurs();
        $kurs->setTrasa($trasa);
        $form = $this->createForm(KursType::class, $kurs);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em-> persist($kurs);
            $em-> flush();

            return $this->redirect($this->generateUrl('admin.kursy', array('id' => $id)));
        }

        return $this->render('admin/kurs.html.twig', [
            'form' => $form->createView(),
            'trasa' => $trasa
        ]);
    }

    /**
      * @Route("/edytuj_kurs/{id}", name="edytuj_kurs")
      */

      public function edytujKurs($id, KursRepository $kursRepo, Request $request) {
        $kurs = $kursRepo->find($id);
        $trasa = $kurs->getTrasa();
        
        $form = $this->createForm(KursType::class, $kurs);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $kurs->setTrasa($trasa);
            $em = $this->getDoctrine()->getManager();
            $em-> persist($kurs);
            $em-> flush();

            return $this->redirect($this->generateUrl('admin.kursy', array('id' => $trasa->getId())));
        }

        return $this->render('admin/kurs.html.twig', [
            'form' => $form->createView(),
            'trasa' => $trasa
        ]);
    }


    /**
     * @Route("/posty", name="posty")
     */

    public function posty(NewsRepository $repo) {
        $newsy = $repo->findAll();

        return $this->render('admin/posty.html.twig', [
            'newsy' => $newsy
        ]);
     }

    /**
     * @Route("/post/{id}", name="post")
     */

    public function displayPost($id, NewsRepository $repo, Request $request) {
        $news = $repo->find($id);

        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em-> persist($news);
            $em-> flush();

            return $this->redirect($this->generateUrl('admin.posty'));
        }

        return $this->render('admin/post.html.twig', [
            'form' => $form->createView()
        ]);
     }

     /**
      * @Route("/nowy_post", name="nowy_post")
      */

      public function nowyPost(Request $request) {
        $news = new News();
        //$post->setTime($trasa);
        $time = date('d/m/Y');
        $news->setTime($time);
        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em-> persist($news);
            $em-> flush();

            return $this->redirect($this->generateUrl('admin.posty'));
        }

        return $this->render('admin/post.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
