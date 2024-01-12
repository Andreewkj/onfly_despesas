<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Expenditure;
use App\Policies\ExpenditurePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Expenditure::class => ExpenditurePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
