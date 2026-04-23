<?php

namespace App\Policies;

use App\Models\FacilityRequest;
use App\Models\User;

class FacilityRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('request.view.any') || $user->can('request.view.own');
    }

    public function view(User $user, FacilityRequest $request): bool
    {
        if ($user->can('request.view.any')) {
            return true;
        }

        return $user->can('request.view.own') && $request->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->can('request.create');
    }

    public function approve(User $user): bool
    {
        return $user->can('request.approve');
    }

    public function delete(User $user, FacilityRequest $request): bool
    {
        return $user->can('request.view.any') || $request->user_id === $user->id;
    }
}
