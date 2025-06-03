<?php

namespace App\Http\Controllers;

use App\Models\Resume\ResumeBuilderSettingsModel;
use App\Models\Resume\ResumeGithubSectionsModel;
use App\Services\FrontService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    public $frontService;
    public function __construct()
    {
        $this->frontService = new FrontService();
    }
    public function index()
    {
        return $this->frontService->frontServiceIndex();
    }

    public function userLoginView()
    {
        return $this->frontService->frontServiceUserLoginView();
    }

    public function userLogin(Request $request)
    {
        return $this->frontService->frontServiceUserLogin($request);
    }

    public function userLogout()
    {
        return $this->frontService->frontServiceUserLogout();
    }
}
