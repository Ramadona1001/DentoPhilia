<?php

namespace Home\Controllers;

use App\Http\Controllers\Controller;
use Home\Repositories\HomeRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public $path;
    private $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->middleware('auth');
        $this->path = 'Home::';
        $this->homeRepository = $homeRepository;
    }

    public function index()
    {
        return view($this->path.'index');
    }
}
