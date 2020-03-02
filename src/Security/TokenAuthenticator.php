<?php
namespace App\Security;
use App\Entity\UserAccountCreation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport\Smtp\Auth\AuthenticatorInterface;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class TokenAuthenticator extends AbstractGuardAuthenticator implements AuthenticatorInterface
{
    use TargetPathTrait;
    private $em;
    private $urlGenerator;
    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
        $this->em = $em;
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
       $data = [
           'message' => 'Authentication Required'
       ];
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     *
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning false will cause this authenticator
     * to be skipped.
     */

    public function supports(Request $request)
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        return $request->headers->get('X-AUTH-TOKEN');
    }

    /**
     * @inheritDoc
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
      if (null === $credentials){
          // The token header was empty, authentication fails with 401
          return null;
      }
        // if a User is returned, checkCredentials() is called
        return $this->em->getRepository(UserAccountCreation::class)
            ->findOneBy(['apiToken' => $credentials]);
    }

    /**
     * @inheritDoc
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if($user->getPassword() === null){
            $data = [
                'message' => 'Authentication Required'
            ];
            return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
        }
         return $this->$user->password->isPasswordValid($user, $credentials['password']);
    }
    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('index'));
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'Unauthorized Token' => strtr($exception->getMessageKey(),$exception->getMessageData())
        ];
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
    /**
     * @inheritDoc
     */
    public function supportsRememberMe()
    {
       return false;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(EsmtpTransport $client): void
    {
        // TODO: Implement authenticate() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuthKeyword(): string
    {
        // TODO: Implement getAuthKeyword() method.
    }
}