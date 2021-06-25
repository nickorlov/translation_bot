<?php

namespace App\Command;

use App\ValueObject\ValueObjectInterface;

class HelpCommand extends AbstractCommand
{
    public function process(ValueObjectInterface $valueObject, string $url)
    {
        $data = [
            'chat_id' => $valueObject->getChatId(),
            'text' => 'Use /lang command to select language to translate.',
        ];

        $this->sendRequest($url, $data);
    }
}
