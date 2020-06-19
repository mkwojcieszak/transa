<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\NewsRepository;
use App\Repository\TrasaRepository;
use App\Repository\KursRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(NewsRepository $newsRepo, TrasaRepository $trasaRepo, KursRepository $kursRepo)
    {
        $news = $newsRepo->findAll();
        $trasyKursy = $trasaRepo->findAllFull($kursRepo);
        $trasy = $trasyKursy['trasy'];
        $kursy = $trasyKursy['kursy'];
        return $this->render('main/index.html.twig', [
            'newsy' => $news,
            'trasy' => $trasy,
            'kursy' => $kursy
        ]);
    }
}
