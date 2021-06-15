<?php

namespace App\ValueObject;

class TelegramBot
{
    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var int */
    private $chatId;

    /** @var string */
    private $text;

    public function __construct(array $data)
    {
        $this->chatId = $data['message']['chat']['id'] ?? 0;
        $this->firstName = $data['message']['from']['first_name'] ?? '';
        $this->lastName = $data['message']['from']['last_name'] ?? '';
        $this->text = $data['message']['text'] ?? '';
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
