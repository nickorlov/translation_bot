<?php

namespace App\Controller;

use App\Service\TelegramService;
use App\ValueObject\TelegramBot;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", methods={"GET"})
     * @Route("/", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->json(['description' => 'API for translation bot']);
    }

    /**
     * @Route("/api/postback", methods={"POST"})
     */
    public function postback(
        Request $request,
        TelegramService $telegramService,
        LoggerInterface $telegramLogger
    ): Response {
        $body = json_decode($request->getContent(), true);
        $telegramLogger->debug('Telegram request', $body);
        $bot = new TelegramBot($body);
        $telegramService->handleRequest($bot);

        return $this->json([
            'code' => 200,
            'message' => 'OK',
        ]);
    }
}
