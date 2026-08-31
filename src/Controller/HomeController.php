<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    #[Route('/')]
    public function index(): Response
    {
        $response = $this->client->request(
            'GET',
            "https://timeapi.io/api/v1/timezone/availabletimezones"
        );

        $timeZones = $response->toArray();

        return $this->render('home.html.twig', [
            'timeZones' => $timeZones,
        ]);
    }
}
