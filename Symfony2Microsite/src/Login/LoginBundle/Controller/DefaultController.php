<?php

namespace Login\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Login\LoginBundle\Entity\Users;
use Login\LoginBundle\Models\Login;

class DefaultController extends Controller {

    public function indexAction(Request $request) {

        $session = $this->getRequest()->getSession();

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('LoginLoginBundle:Users');

        if ($request->getMethod() == 'POST') {
            $session->clear();
            $username = $request->get('username');
            $password = sha1($request->get('password'));
            $remember = $request->get('remember');

            $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
            if ($user) {
                if ($remember == 'remeber-me') {
                    $login = new Login();
                    $login->setUsername($username);
                    $login->setPassword($password);
                    $session->set('login', $login);
                }

                return $this->render('LoginLoginBundle:Default:welcome.html.twig', array('name' => $user->getFirstName()));
            } else {
                return $this->render('LoginLoginBundle:Default:login.html.twig', array('name' => 'Login Falid'));
            }
        } else {
            if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->setUsername();
                $password = $login->setPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                    return $this->render('LoginLoginBundle:Default:welcome.html.twig', array('name' => $user->getFirstName()));
                }
            }
            return $this->render('LoginLoginBundle:Default:login.html.twig');
        }
    }

    public function signupAction(Request $request) {
        if ($request->getMethod() == 'POST') {
            $username = $request->get('username');
            $password = $request->get('password');
            $email = $request->get('email');
            $comments = $request->get('comments');             
            $firstname = $request->get('firstname');

            $user = new Users();
            $user->setUserName($username);            
            $user->setFirstName($firstname);
            $user->setPassword(sha1($password));
            $user->setEmail($email);
            $user->setText($comments);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();
        }
        return $this->render('LoginLoginBundle:Default:signup.html.twig');
    }
    public function logoutAction(Request $request) {
        
        $session = $this->getRequest()->getSession();
        $session->clear();
        return $this->render('LoginLoginBundle:Default:login.html.twig');
    }
}
