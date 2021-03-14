<?php

namespace LabsMarket\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use LabsMarket\Repositories\LabsMarketRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use LabsMarket\Requests\LabsMarketRequest;
use LabsMarket\Requests\LabsMarketRequestUpdate;

class LabsMarketController extends Controller
{
    public $path;
    private $labsMarketRepository;

    public function __construct(LabsMarketRepository $labsMarketRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'LabsMarket::';
        $this->labsMarketRepository = $labsMarketRepository;
    }

    public function index()
    {
        hasPermissions('show_labs_market');

        $title = transWord('All Labs Market');
        $pages = [
            [transWord('All Labs Market'),'labsMarket']
        ];
        $labsMarket = $this->labsMarketRepository->allData();
        $firstCat = $this->labsMarketRepository->allFirstCat();
        return view($this->path.'index',compact('labsMarket','pages','title','firstCat'));
    }


    public function filterSecondCat($firstcat)
    {
        $data = $this->labsMarketRepository->getSecondDataByFirstCategory($firstcat);
        return response()->json(['data'=>$data]);
    }

    public function filter(Request $request)
    {
        $labsMarket = $this->labsMarketRepository->getItemFiltered($request);
        $title = transWord('All Labs Market');
        $pages = [
            [transWord('All Labs Market'),'labsMarket']
        ];
        $firstCat = $this->labsMarketRepository->allFirstCat();
        return view($this->path.'filter',compact('labsMarket','pages','title','firstCat','request'));
    }

}
