<?php

namespace App\Controller;
use App\Repository\User2Repository;
use App\Entity\User2;
use App\Form\loginType;
use App\Form\User2Type;
use App\Form\SearchUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Swift_Mailer;
use Swift_Message;
use App\Form\ForgetpasswortType;







class UserController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    #[Route('/adduser', name: 'add_user')]
public function adduser(Request $request): Response
{
    $user = new User2();

    $form = $this->createForm(User2Type::class, $user);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $plainPassword = $user->getMdpuser();
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setMdpuser($encodedPassword);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('app_template');
    }

    return $this->render('user/adduser.html.twig', ['f' => $form->createView()]);
}
#[Route('/login', name: 'app_user_login')]
public function login(Request $request, User2Repository $userRepository): Response
{   
    $form = $this->createForm(loginType::class);

    $form->handleRequest($request);
    $session = $request->getSession();
    
    if ($form->isSubmitted() && $form->isValid()) {
        $email = $form->get('mailuser')->getData();
        $password = $form->get('mdpuser')->getData();
        
        $user = $userRepository->verif($email, $password);
        
        if ($user && $user->isIsblocked()) {
            $this->addFlash('danger', 'Votre compte est bloqué. Veuillez contacter l\'administrateur.');
        } elseif ($user) {
            $session->set('User2', $user);
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        } else {
            $this->addFlash('error', 'Invalid credentials');
        }
    }

    return $this->render('user/Loginuser.html.twig', [
        'f' => $form->createView()
    ]); 
}


   

   #[Route('/appuser', name: 'app_user')]
    public function index(): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User2::class)->findAll();

        
        return $this->render('user/index.html.twig', ['b'=>$user ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User2 $user, User2Repository $userRepository): Response
    {
       
        $form = $this->createForm(User2Type::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
    
            return $this->redirectToRoute('app_user'); 
        }
    
        return $this->renderForm('user/updateuser.html.twig', [
            'User' => $user,
            'f' => $form,
            
        ]);
    }
  
    #[Route('/forgot', name: 'forgot')]
    public function forgotPassword(Request $request, User2Repository $userRepository,Swift_Mailer $mailer, TokenGeneratorInterface  $tokenGenerator)
    {


        $form = $this->createForm(ForgetpasswortType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->getData();


            $user = $userRepository->findOneBy(['mailuser'=>$donnees]);
            if(!$user) {
                $this->addFlash('danger','cette adresse n\'existe pas');
                return $this->redirectToRoute("forgot");

            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManger = $this->getDoctrine()->getManager();
                $entityManger->persist($user);
                $entityManger->flush();




            }catch(\Exception $exception) {
                $this->addFlash('warning','une erreur est survenue :'.$exception->getMessage());
                return $this->redirectToRoute("app_user_login");


            }

            $url = $this->generateUrl('app_reset_password',array('token'=>$token),UrlGeneratorInterface::ABSOLUTE_URL);

          
            $message = (new Swift_Message('Mot de password oublié'))
                ->setFrom('haithem.lahdhiri@esprit.tn')
                ->setTo($user->getmailuser())
                ->setBody("<p> Bonjour</p> unde demande de réinitialisation de mot de passe a été effectuée. Veuillez cliquer sur le lien suivant :".$url,
                "text/html");

           
            $mailer->send($message);
            $this->addFlash('message','E-mail  de réinitialisation du mp envoyé :');
        //    return $this->redirectToRoute("app_login");

        }

        return $this->render("user/forgotpassword.html.twig",['form'=>$form->createView()]);
    }
     #[Route('/resetpassword/{token}', name: 'app_reset_password')]
    public function resetpassword(Request $request,string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getDoctrine()->getRepository(User2::class)->findOneBy(['reset_token'=>$token]);

        if($user == null ) {
            $this->addFlash('danger','TOKEN INCONNU');
            return $this->redirectToRoute("app_user_login");

        }

        if($request->isMethod('POST')) {
            $user->setResetToken(null);
        
            $plainPassword = $user->getMdpuser();
            $user->setmdpuser($passwordEncoder->encodePassword($user,$plainPassword));
            $entityManger = $this->getDoctrine()->getManager();
            $entityManger->persist($user);
            $entityManger->flush();

            $this->addFlash('message','Mot de passe mis à jour :');
            return $this->redirectToRoute("app_user_login");

        }
        else {
            return $this->render("user/resetPassword.html.twig",['token'=>$token]);

        }
    }
    #[Route('/admin/block-user/{id}', name: 'admin_block_user')]
    public function blockUser(User2 $user, Request $request)
    {
     
        $user->setIsblocked(!$user->isIsblocked());

        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        
        return $this->redirectToRoute('app_user', ['id' => $user->getIduser()]);
    }
    #[Route('/tirer', name: 'tirerusers')]
    public function yourAction(User2Repository $userRepository): Response
    {
        $user = $userRepository->findAllAlphabeticalOrder();

      

        return $this->render('user/index.html.twig', [
            'b' => $user,
        ]);
    }
    #[Route('/searchuser', name: 'searchuser')]
    public function searchAction(Request $request, User2Repository $userRepository): Response
    {
        $user = $request->request->get('nomuser');
              
        if ($user) {
            $users = $userRepository->searchusers($user);
        } else {
            
            $users = $userRepository->findAll();
        }
    
        return $this->render('user/search_results.html.twig', [
            'users' => $users,  
        ]);
    }
   
}

