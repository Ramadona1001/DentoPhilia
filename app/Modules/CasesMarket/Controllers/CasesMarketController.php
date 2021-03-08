<?php

namespace CasesMarket\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use CasesMarket\Repositories\CasesMarketRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use CasesMarket\Requests\CasesMarketRequest;
use CasesMarket\Requests\CasesMarketRequestUpdate;

class CasesMarketController extends Controller
{
    public $path;
    private $casesMarketRepository;

    public function __construct(CasesMarketRepository $casesMarketRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'CasesMarket::';
        $this->casesMarketRepository = $casesMarketRepository;
    }

    public function index()
    {
        hasPermissions('show_cases_market');

        $title = transWord('All Cases Market');
        $pages = [
            [transWord('All Cases Market'),'casesMarket']
        ];
        $casesMarket = $this->casesMarketRepository->allData();
        return view($this->path.'index',compact('casesMarket','pages','title'));
    }


    public function filter(Request $request)
    {
        $casesMarket = $this->casesMarketRepository->getItemFiltered($request);
        $title = transWord('All Cases Market');
        $pages = [
            [transWord('All Cases Market'),'casesMarket']
        ];
        return view($this->path.'filter',compact('casesMarket','pages','title','request'));
    }

}
