<?php
namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GoogleController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/google", name="connect_google_start")
     * @param ClientRegistry $clientRegistry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        // will redirect to Google OAuth !
        return $clientRegistry
            ->getClient('google') // key used in config/packages/knpu_oauth2_client.yaml
            ->redirect([
            'profile', 'email' // the scopes you want to access
            ])
        ;
    }

    /**
     * @Route("/connect/google/check", name="connect_google_check")
     *
     * @return JsonResponse
     */
    public function connectCheck()
    {
        // This response is never sent, Guard handle Response
        if (!$this->getUser()) {
            return new JsonResponse(array('status' => false, 'message' => "User not found!"));
        } else {
            return new JsonResponse(array('status' => true, 'token' => $this->getUser()->getToken()));
        }
    }
}
