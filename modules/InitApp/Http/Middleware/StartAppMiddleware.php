<?php

namespace Modules\InitApp\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Storage;
use Modules\InitApp\Repositories\InitRepository;
use Modules\InitApp\Repositories\InitServiceRepository;

class StartAppMiddleware
{
    protected $repo, $service_repo;

    public function __construct(
        InitRepository $repo,
        // InitServiceRepository $service_repo
    ) {
        $this->repo = $repo;
        // $this->service_repo = $service_repo;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $this->repo->init();

        // $this->service_repo->init();

        // if ($this->inExceptArray($request)) {
        //     return $next($request);
        // }


        // $this->service_repo->check();

        // $c = Storage::exists('.app_installed') ? Storage::get('.app_installed') : false;
        // if (!$c) {
        //     return redirect('/install');
        // }

        $this->repo->config();

        return $next($request);
    }

    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'install', 'install/*'
    ];

    protected function inExceptArray($request)
    {

        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }
            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
