<?php

namespace App\Listeners;

use App\Enums\Roles;
use App\Notifications\SubmitJobAdForApproval;
use App\Services\User\UserServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotifyModerators
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $userService = app(UserServiceInterface::class);
        $moderators = $userService->getByRole(Roles::Moderator);
        Notification::send($moderators, new SubmitJobAdForApproval($event->jobAd));
    }
}
