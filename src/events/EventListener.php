<?php

namespace app\events;

use yii\base\Event;

class EventListener
{
    public static function register(): array
    {
        return [];
    }

    public static function init()
    {
        $events = self::register();
        foreach ($events as $event) {
            foreach ($event['handlers'] as $handler) {
                Event::on(
                    $event['dispatcher'],
                    $event['eventName'],
                    $handler
                );
            }
        }
    }
}
