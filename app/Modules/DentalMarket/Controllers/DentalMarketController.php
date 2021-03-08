<?php

namespace DentalMarket\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use DentalMarket\Repositories\DentalMarketRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use DentalMarket\Requests\DentalMarketRequest;
use DentalMarket\Requests\DentalMarketRequestUpdate;

class DentalMarketController extends Controller
{
    public $path;
    private $dentalMarketRepository;

    public function __construct(DentalMarketRepository $dentalMarketRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'DentalMarket::';
        $this->dentalMarketRepository = $dentalMarketRepository;
    }

    public function index()
    {
        hasPermissions('show_dental_market');

        $title = transWord('All DentalMarket');
        $pages = [
            [transWord('All DentalMarket'),'dentalMarket']
        ];
        $dentalMarket = $this->dentalMarketRepository->allData();
        $firstCat = $this->dentalMarketRepository->allFirstCat();
        return view($this->path.'index',compact('dentalMarket','pages','title','firstCat'));
    }


    public function filterSecondCat($firstcat)
    {
        $data = $this->dentalMarketRepository->getSecondDataByFirstCategory($firstcat);
        return response()->json(['data'=>$data]);
    }

    public function filter(Request $request)
    {
        $dentalMarket = $this->dentalMarketRepository->getItemFiltered($request);
        $title = transWord('All DentalMarket');
        $pages = [
            [transWord('All DentalMarket'),'dentalMarket']
        ];
        $firstCat = $this->dentalMarketRepository->allFirstCat();
        return view($this->path.'filter',compact('dentalMarket','pages','title','firstCat','request'));
    }

}
