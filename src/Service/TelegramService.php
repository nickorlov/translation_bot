<?php

namespace App\Service;

use App\Command\AbstractCommand;
use App\HttpClient\Client;
use App\ValueObject\TelegramBot;
use Dejurin\GoogleTranslateForFree;

class TelegramService
{
    /** @var string */
    private $token;

    /** @var GoogleTranslateForFree */
    private $translator;

    public function __construct(string $token, GoogleTranslateForFree $translator)
    {
        $this->token = $token;
        $this->translator = $translator;
    }

    public function handleRequest(TelegramBot $bot)
    {
        $url = sprintf("https://api.telegram.org/bot%s/sendMessage", $this->token);
        if ($bot->getText() !== '') {
            if ($this->handleEntities($bot, $url)) {
                return;
            }
            $translatedText = $this->translator->translate('en', 'ru', $bot->getText());
        } else {
            $translatedText = 'Error! I can work with text only.';
        }
        $data = [
            'chat_id' => $bot->getChatId(),
            'text' => $translatedText,
        ];

        $client = new Client();
        $client->request('POST', $url, ['json' => $data]);
    }

    private function handleEntities(TelegramBot $bot, string $url): bool
    {
        if ($bot->getEntities() === null) {
            return false;
        }

        $command = AbstractCommand::createCommand($bot->getText());
        $command->process($bot, $url);

        return true;
    }
}
