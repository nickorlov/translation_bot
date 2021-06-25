<?php

namespace App\Command;

use App\ValueObject\ValueObjectInterface;

class UnknownCommand extends AbstractCommand
{
    public function process(ValueObjectInterface $valueObject, string $url)
    {
        $data = [
            'chat_id' => $valueObject->getChatId(),
            'text' => 'Unknown command.',
        ];

        $this->sendRequest($url, $data);
    }
}
