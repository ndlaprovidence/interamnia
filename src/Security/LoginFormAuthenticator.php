<?php

// Ajouter l'email s'il n'existe pas -> Utiliser try and catch pour utiliser l'erreur
// Comparaison des mots de passe

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;  

    private $entityManager;
    private $urlGenerator;
    private $csrfTokenManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        return 'app_login' === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'login' => $request->request->get('login'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['login']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        global $login, $givenname, $sn, $role, $bts;

        $ldaprdn  = 'btssio';
        $ldappass = 'sisr';   
        $credentials_login = $credentials['login'];

        $ldapconn = ldap_connect("172.16.122.250") or die ("Impossible de se connecter au serveur LDAP.");

        if ($ldapconn) {

            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
        
            if ($ldapbind) {
                // echo "Connexion LDAP réussie !";
                $token = new CsrfToken('authenticate', $credentials['csrf_token']);
                if (!$this->csrfTokenManager->isTokenValid($token)) {
                    throw new InvalidCsrfTokenException();
                }

                $user = $this->entityManager->getRepository(User::class)->findOneBy(['login' => $credentials_login]);
                //dump($user); exit;
                $password = $credentials['password'];
                
                if (!$user) { 

                    $user = new User();

                    $user->setLogin($credentials_login);

                    $sr = ldap_search($ldapconn, "ou=bts, ou=Eleves, ou=utilisateurs, dc=ndlp, dc=fr", "sAMAccountName=$credentials_login");
                    $data = ldap_get_entries($ldapconn, $sr);
                    // dump($data);

                    for ($i=0; $i<$data["count"]; $i++) {
                        $login = $data[$i]["samaccountname"][0];
                        $givenname = $data[$i]["givenname"][0];
                        $sn = $data[$i]["sn"][0];
                        $mail = $data[$i]["mail"][0];
                        dump($mail); exit;
                        $role = ["ROLE_USER"];

                        if ($data[$i]["scriptpath"][0] == 'sio1.cmd' || $data[$i]["scriptpath"][0] == 'sio2.cmd') {
                            $bts = '1';
                        } elseif ($data[$i]["scriptpath"][0] == 'sam1.cmd' || $data[$i]["scriptpath"][0] == 'sam2.cmd') {
                            $bts = '2';
                        } elseif ($data[$i]["scriptpath"][0] == 'ag1.cmd' || $data[$i]["scriptpath"][0] == 'ag2.cmd') {
                            $bts = '3';
                        } elseif ($data[$i]["scriptpath"][0] == 'gpme1.cmd' || $data[$i]["scriptpath"][0] == 'gpme2.cmd') {
                            $bts = '4';
                        }
                    }

                    // Créer des variables pour chaque donnée
                    if ($user->getLogin() == $login) {
                        // $entityManager = $this->getDoctrine()->getManager();
                        $entityManager = $this->entityManager;

                        // $user->setBTS($bts);
                        $user->setNom($sn);
                        $user->setPrenom($givenname);
                        $user->setEmail($mail);
                        $user->setLogin($login);
                        $user->setRoles($role);
                        $user->setPassword($this->passwordEncoder->encodePassword(
                            $user,
                            $password
                        ));

                        $entityManager->persist($user);

                        $entityManager->flush();
                        
                        // $query = $this->entityManager->createQuery("INSERT INTO User (bts_id, nom, prenom, roles) VALUES ($bts, $sn, $givenname, $role)");
                        // return $query->getResult();
                        // Ajouter cette utilisateur dans la BD locale (Utilisation du SQL ? -> SQL Update)
                        // https://symfony.com/doc/current/reference/forms/types/hidden.html
                    } else {
                        //fail authentication with a custom error
                        throw new CustomUserMessageAuthenticationException('Nom d\'utilisateur introuvable !');
                    }
                }
                
                // $data = ldap_get_entries($ldapconn, $sr);
                
                // echo '<h1>Dump all data</h1><pre>';
                // print_r($data);   
                // echo '</pre>';
            } else {
                // echo "Connexion LDAP échouée !";
            }
        }
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        // Ajouter le mot de passe dans la BD
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('entreprise_index'));
        //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('app_login');
    }
}