<?php

namespace CasesMarket\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use CasesMarket\Repositories\CasesMarketRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Cases\Models\Cases;
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

    public function allDentalProducts()
    {
        if(isset($_GET["action"]))
        {
            $total_row = Cases::where('id','>',0);

            if (isset($_GET['items_search'])) {
                $total_row->where('preoperative_title','like','%'.$_GET['items_search'].'%')
                     ->orWhere('processingoperative_title','like','%'.$_GET['items_search'].'%')
                     ->orWhere('postoperative_title','like','%'.$_GET['items_search'].'%');
            }

            if (isset($_GET['case_name'])) {
                if (count($_GET['case_name']) > 1) {
                    $total_row->whereIn('type',$_GET['case_name']);
                }else{

                    $total_row->where('type',$_GET['case_name'][0]);
                }
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
