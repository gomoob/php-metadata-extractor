<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\BinaryDriver;

use Evenement\EventEmitter;
use Alchemy\BinaryDriver\Listeners\ListenerInterface;
use Symfony\Component\Process\Process;

class DebugListener extends EventEmitter implements ListenerInterface
{
    public function handle($type, $data)
    {
        foreach (explode(PHP_EOL, $data) as $line) {
            $this->emit($type === Process::ERR ? 'error' : 'out', array($line));
        }
    }

    public function forwardedEvents()
    {
        // forward 'error' events to the BinaryInterface
        return array('error');
    }
}
