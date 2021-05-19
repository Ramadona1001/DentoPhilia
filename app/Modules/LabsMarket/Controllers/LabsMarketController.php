<?php

namespace LabsMarket\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use LabsMarket\Repositories\LabsMarketRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Items\Models\Item;
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

    public function allLabsProducts()
    {
        if(isset($_GET["action"]))
        {
            $total_row = Item::where('id','>',0)->where('species',1)->where('publish',1);
            if (isset($_GET['items_search'])) {
                $total_row->where('name','like','%'.$_GET["items_search"].'%');
            }

            if (isset($_GET['first_category'])) {
                if (count($_GET['first_category']) > 1) {
                    $total_row->whereIn('first_category',$_GET['first_category']);
                }else{

                    $total_row->where('first_category',$_GET['first_category'][0]);
                }
            }


            if (isset($_GET['second_category'])) {
                if (count($_GET['second_category']) > 1) {
                    $total_row->whereIn('second_category',$_GET['second_category']);
                }else{
                    $total_row->where('second_category',$_GET['second_category'][0]);
                }
            }


            if ($_GET['price_from'] != null && $_GET['price_to'] != null) {
                $total_row->whereBetween('price',[$_GET['price_from'],$_GET['price_to']]);
            }elseif ($_GET['price_from'] != null && $_GET['price_to'] == null) {
                $total_row->where('price','>=',$_GET['price_from']);
            }elseif($_GET['price_from'] == null && $_GET['price_to'] != null) {
                $total_row->where('price','<=',$_GET['price_to']);
            }elseif($_GET['price_from'] == null && $_GET['price_to'] == null){
                $total_row->where('price','>=','0');
            }

            $output = '';
            if(count($total_row->get()) > 0)
            {
                foreach($total_row->get() as $item)
                {
                    $output .= '<div class="product-preview">';
                        $output .= '<a href="marketplace-product.html">';
                            $output .= '<figure class="product-preview-image liquid" style="background: url('.asset("uploads/business_accounts/items/".$item->image).') center center / cover no-repeat;">';
                                $output .= '<img src="'.asset("uploads/business_accounts/items/".$item->image).'" alt="item-01" style="display: none;">';
                            $output .= '</figure>';
                        $output .= '</a>';

                        $output .= '<div class="product-preview-info" style="min-height: 132px;">';
                            $output .= '<p class="text-sticker"><span class="highlighted">$</span>'.$item->price.'</p>';
                            $output .= '<p class="product-preview-title"><a href="marketplace-product.html">'.$item->name.'</a></p>';
                            if ($item->first_category != null){
                                $output .= '<p class="product-preview-category digital">';
                                    $output .= '<a href="#">'.transWord("First Category").': '.$item->firstCat->name.'</a>';
                                $output .= '</p>';
                            }
                            if ($item->second_category != null){
                                $output .= '<p class="product-preview-category digital">';
                                    $output .= '<a href="#">'.transWord("Second Category").': '.$item->secondCat->name.'</a>';
                                $output .= '</p>';
                            }
                            if ($item->third_category != null){
                                $output .= '<p class="product-preview-category digital">';
                                    $output .= '<a href="#">'.transWord("Third Category").': '.$item->thirdCat->name.'</a>';
                                $output .= '</p>';
                            }
                        $output .= '</div>';

                        $output .= '<div class="product-preview-meta">';
                            $output .= '<div class="product-preview-author">';
                                $output .= '<a class="product-preview-author-image user-avatar micro no-border" href="profile-timeline.html">';
                                    $output .= '<div class="user-avatar-content">';
                                        $output .= '<img class="hexagon-image-18-20" src="'.asset(getUserAvatar($item->user->id)).'" style="width: 18px; height: 20px; position: relative;" />';
                                    $output .= '</div>';
                                $output .= '</a>';
                                $output .= '<p class="product-preview-author-title">'.transWord("Posted By").'</p>';
                                $output .= '<p class="product-preview-author-text"><a href="profile-timeline.html">'.$item->user->name.'</a></p>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                }
            }
            else
            {
                $output = '<h3>No Data Found</h3>';
            }
            echo $output;
        }
    }

}
