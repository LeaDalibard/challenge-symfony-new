<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LearningController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homePage(): Response
    {
        return $this->redirectToRoute("show-my-name");
    }

    /**
     * @Route("/about-me", name="aboutMe")
     */
    public function aboutMe(): Response
    {
        return $this->render('learning/about-me.html.twig');
    }

    /**
     * @Route("/show-my-name", name="show-my-name")
     */
    public function showMyName(): Response
    {
        if ($this->session->get('name')) {
            $name = $this->session->get('name');} else {
            $name = 'Unknown';
        }

        return $this->render('learning/show-my-name.html.twig', ['name' => $name]);

    }

    /**
     * @Route("/change-my-name",name="change-my-name", methods="POST")
     */

    //path should be put in method in the form

    public function changeMyName(): Response
    {
        if ($_POST['name']) {
            $name = $_POST['name'];
            $this->session->set('name', $name);
            return $this->render('learning/show-my-name.html.twig', ['name' => $this->session->get('name')]);
        }
    }


}


