<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\UserActivity;

class LogUserActivity
{
    public $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $user = auth()->user();
        $userId = $user->id;

        if ($user && method_exists($user, 'userActivities')) {
            if ($request->is('roles/*')) {
                $activity = $this->getRoleActivity($request);
            } else {
                $activity = 'Did Nothing';
            }

            if ($userId != null) {
                $userActivity = new UserActivity([
                    'activity' => $activity,
                    'user_id' => $userId, // Set a valid user ID
                ]);
                $userActivity->save();
            }
        }

        return $response;
    }

    private function getRoleActivity($request)
    {
        if ($request->isMethod('post')) {
            return 'Created a new role';
        } elseif ($request->isMethod('put')) {
            return 'Updated a role';
        } elseif ($request->isMethod('delete')) {
            return 'Deleted a role';
        }

        return 'Performed a role-related action';
    }
}
