<?php

namespace App\Actions;

use App\Notifications\EventPublished;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CreateEvent
{
    public function execute($data, $request)
    {
        DB::transaction(function () use ($data, $request) {
            $event = auth()->user()->events()->create($data);

            if ($request->hasFile('image')) {
                $event
                    ->getFirstMedia('banner')
                    ?->delete();

                $event->addMedia($data['image'])
                    ->toMediaCollection('banner');
            }

            if ($request->has('tickets')) {
                $event->ticket()->createMany($request->tickets);
            }

            $details = [
                'title' => $event->id,
                'body' => auth()->user()->username.' created a new event',
            ];

            //Send notification
            $users = auth()->user()->profile->followers;
            Notification::send($users, new EventPublished($details));
        });

    }
}
