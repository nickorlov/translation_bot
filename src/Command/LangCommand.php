<?php

namespace App\Command;

use App\ValueObject\ValueObjectInterface;

class LangCommand extends AbstractCommand
{
    public function process(ValueObjectInterface $valueObject, string $url)
    {
        $data = [
            'chat_id' => $valueObject->getChatId(),
            'text' => 'Currently, only English to Russian translation is available.',
        ];

        $this->sendRequest($url, $data);
    }
}
