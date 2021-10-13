<?php

namespace Modules\InitApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\InitApp\Http\Requests\UserRequest;
use Modules\InitApp\Repositories\InstallRepository;
use Modules\InitApp\Repositories\InstallServiceRepository;

class InitAppController extends Controller
{
    protected $repo, $request, $service_repo;

    public function __construct(
        InstallRepository $repo,
        Request $request,
        InstallServiceRepository $service_repo
    ) {
        $this->repo = $repo;
        $this->request = $request;
        $this->service_repo = $service_repo;
    }

    public function index()
    {
        $this->service_repo->checkInstallation();
        return view('hub::install.welcome');
    }


    public function user()
    {
        $ac = Storage::exists('.temp_app_installed') ? Storage::get('.temp_app_installed') : null;
        if (!$this->service_repo->checkDatabaseConnection() || !$ac) {
            abort(404);
        }

        return view('hub::install.user');
    }

    public function post_user(UserRequest $request)
    {
        try {
            $this->service_repo->install($request->all());
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

        $this->repo->install($request->all());
        return response()->json(['message' => __('hub::install.done_msg'), 'goto' => route('service.done')]);
    }
}
