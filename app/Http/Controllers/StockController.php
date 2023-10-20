<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserStock;

class StockController extends Controller
{
    public function index() //追加
    {
            $stocks = Stock::SimplePaginate(8);
            return view('stocks',compact('stocks'));
    }

    public function myCart(UserStock $userStock)
    {
        $myCartStocks = $userStock->showMyCart();
        return view('myCart',compact('myCartStocks'));
    }

    public function addMyCart(Request $request,UserStock $userStock)
   {

       //カートに追加の処理
       $stockId=$request->stockId;
       $message = $userStock->addMyCart($stockId);

       //追加後の情報を取得
       $myCartStocks = $userStock->showMyCart();

       return view('myCart',compact('myCartStocks' , 'message'));

   }

    public function deleteMyCartStock(Request $request,UserStock $userStock)
    {

        //カートから削除の処理
        $stockId=$request->stockId;
        $message = $userStock->deleteMyCartStock($stockId);

        //追加後の情報を取得
        $myCartStocks = $userStock->showMyCart();

        return view('myCart',compact('myCartStocks' , 'message'));

    }
}
