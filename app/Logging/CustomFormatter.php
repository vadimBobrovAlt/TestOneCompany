<?php


namespace App\Logging;


use Monolog\Formatter\LineFormatter;

class CustomFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                "[%datetime%] %level_name%: %message%\n",
                "Y-n-j H:i:s"
            ));
        }
    }
}
