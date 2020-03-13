<?php

namespace App\Providers;

use App\interfaces\agents;
use App\interfaces\contacts;
use App\interfaces\issuesType;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\interfaces\Tickets;
use App\Repositories\TicketRepo;
use App\interfaces\Level;
use App\Repositories\LevelRepo;
use App\Repositories\PriorityRepo;
use App\interfaces\Priority;
use App\interfaces\Source;
use App\Repositories\AgentsRepo;
use App\Repositories\ContactRepo;
use App\Repositories\IssuesRepo;
use App\Repositories\SourceRepo;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $baseUrl = env('SERVICE_BASE_URL');
        $this->app->singleton('GuzzleHttp\Client', function($api) use ($baseUrl) {
                return new Client([
                    'base_url' => $baseUrl,
                ]);
        
        });

        $this->app->singleton('mailer', function ($app) { 
  $app->configure('services'); 
  return $app->loadComponent('mail', 'Illuminate\Mail\MailServiceProvider', 'mailer'); 
});
       
        //$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->registerTicketRepo();
        $this->registerLevelRepo();
        $this->registerPriority();
        $this->registerIssueType();
        $this->registerSources();
        $this->registercontact();
        $this->registerAgents();
    }

    public function registerTicketRepo()
    {
        return $this->app->bind(Tickets::class, TicketRepo::class);
    }

    public function registerLevelRepo()
    {
        return $this->app->bind(Level::class, LevelRepo::class);
    }

    public function registerPriority()
    {
        return $this->app->bind(Priority::class, PriorityRepo::class);
    }

    public function registerIssueType()
    {
        return $this->app->bind(issuesType::class, IssuesRepo::class);
    }

    public function registerSources()
    {
        return $this->app->bind(Source::class, SourceRepo::class);
    }

    public function registercontact()
    {
        return $this->app->bind(contacts::class, ContactRepo::class);
    }

    public function registerAgents()
    {
        return $this->app->bind(agents::class, AgentsRepo::class);
    }
}
