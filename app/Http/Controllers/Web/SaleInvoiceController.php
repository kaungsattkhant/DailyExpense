<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Product;
use App\Model\SaleInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleInvoiceController extends Controller
{
    public function index(){
        $customers=Customer::all();
        return view('SaleInvoice.index',compact('customers'));
    }
    public function get_product_name(Request $request){
        $products = Product::where('name','LIKE',$request->search.'%')
            ->orderBy('name','asc')
            ->get();
        if($products->isNotEmpty()){
            return response()->json([
                'is_success'=>true,
                'products'=>$products
            ]);
        }else{
            return response()->json([
                'is_success'=>false,
            ]);
        }
    }
    public function sale_create(Request $request){
        $data=json_encode($request->products);
        $decode_data=json_decode($data);
        $latest=SaleInvoice::latest()->first();
        $invoice_no=$this->getInvoiceNo($latest);
        if(Auth::user()!=null){
            $sale=SaleInvoice::create([
                'invoice_no'=>$invoice_no,
                'date_time'=>Carbon::now(),
                'user_id'=>Auth::user()->id,
                'customer_id'=>$request->customer_id,
                'total_kyats'=>$request->total,
            ]);
            foreach($decode_data as $product) {

                $it=Product::whereId($product->id)->first();
                if($it!=null){
                    $update_qty=$it->remain_qty-$product->qty;
                    $it->update([
                        'remain_qty'=>$update_qty
                    ]);
                }
                $sale->products()->attach($product->id, ['qty' => $product->qty]);
            }
            return response()->json([
                'is_success'=>true,
            ]);
        } else{
            Auth::logout();
        }

    }
    public function sale_record(){
//        dd(Auth::user());
        $sale_invoices=SaleInvoice::orderBy('id','desc')->paginate(15);
        return view('SaleInvoice.sale_record',compact('sale_invoices'));
    }
    public function sale_record_filter(Request  $request){
//        dd($request->date);
//        $date=Carbon::createFromFormat('Y-m-d', $request->from_date);
        $date=$request->date;
        $sale_invoices=SaleInvoice::whereDate('date_time',$date)->paginate(10);
        return view('SaleInvoice.sale_record_filter',compact('sale_invoices'));

    }
    public function detail(Request  $request){
//        dd($id);
        $sale_invoice=SaleInvoice::whereid($request->id)->firstOrfail();
        $products=$sale_invoice->products;
        return view('SaleInvoice.detail_view',compact('products'));
    }
    protected function  getInvoiceNo($last_sale){
//        $tr_date=Carbon::parse($last_transaction->date_time);
        $num=0;
        if($last_sale!=null){

            $date=$last_sale->date_time;
            $last_invoice=$last_sale->invoice_no;
            $num=substr($last_invoice,-5);
        }else{
            $date=Carbon::now();
            $num=0;
        }

//        $first=substr($branch->name,0,1);
        $from = Carbon::parse($date)->startOfDay();
        $to = Carbon::parse(Carbon::today())->startOfDay();
        $d=$to->diffIndays($from);
        if($d<=0){
            $a=(str_pad((int)$num + 1, 5, '0', STR_PAD_LEFT));
        }
        else if($d>=1)
        {
            $num=0;
            $a=(str_pad((int)$num + 1, 5, '0', STR_PAD_LEFT));
        }
        $date= str_replace("-", "", Carbon::today()->format('d-m-Y'));
        $invoice_no="SI".$date.$a;
        return $invoice_no;
    }
}
