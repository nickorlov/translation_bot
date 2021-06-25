<?php

namespace App\ValueObject;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TelegramBot implements ValueObjectInterface
{
    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var int */
    private $chatId;

    /** @var string */
    private $text;

    /** @var array|null */
    private $entities;

    public function __construct(array $data)
    {
        $message = $data['message'] ?? $data['edited_message'] ?? null;
        if ($message === null) {
            throw new BadRequestException('Message is required!');
        }
        $this->chatId = $message['chat']['id'] ?? 0;
        $this->firstName = $message['from']['first_name'] ?? '';
        $this->lastName = $message['from']['last_name'] ?? '';
        $this->text = $message['text'] ?? '';

        $this->entities = $message['entities'] ?? null;
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

    public function getEntities(): ?array
    {
        return $this->entities;
    }
}
