<?php

namespace App\Providers;

use App\Models\ActivityPurpose;
use App\Models\FacilityRequest;
use App\Policies\ActivityPurposePolicy;
use App\Policies\FacilityRequestPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(FacilityRequest::class, FacilityRequestPolicy::class);
        Gate::policy(ActivityPurpose::class, ActivityPurposePolicy::class);
    }
}
