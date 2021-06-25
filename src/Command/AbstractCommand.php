<?php

namespace App\Command;

use App\HttpClient\Client;
use App\ValueObject\ValueObjectInterface;

abstract class AbstractCommand
{
    /**
     * @param  string  $command
     * @return AbstractCommand
     */
    public static function createCommand(string $command): AbstractCommand
    {
        switch($command) {
            case '/help':
                return new HelpCommand();
            case '/lang':
                return new LangCommand();
            default:
                return new UnknownCommand();
        }
    }

    abstract public function process(ValueObjectInterface $valueObject, string $url);

    protected function sendRequest(string $url, array $data)
    {
        $client = new Client();
        $client->request('POST', $url, ['json' => $data]);
    }
}
