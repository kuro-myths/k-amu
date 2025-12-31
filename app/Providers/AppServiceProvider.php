<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Note;
use App\Models\Project;
use App\Models\BugReport;
use App\Policies\NotePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\BugReportPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Note::class => NotePolicy::class,
        Project::class => ProjectPolicy::class,
        BugReport::class => BugReportPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}
