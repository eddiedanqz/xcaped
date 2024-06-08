<?php

namespace App\Actions;

class CreateEvent
{
    public function execute($data)
    {
        $event = auth()->user()->events()->create($data);

        if ($request->has('tickets')) {
            $event->ticket()->createMany($request->tickets);
        }

    }
}
