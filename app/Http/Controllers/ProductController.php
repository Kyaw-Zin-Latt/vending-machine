<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $params = $request;

        $products = Product::with(['currency'])
                    ->when($params->searchKey, function ($q) use ($params){
                        $q->where('name','LIKE', "%$params->searchKey%");
                    })
                    ->when($params->field, function ($q) use ($params){
                        $q->orderBy("$params->field", "$params->direction");
                    })
                    ->latest("id")
                    ->paginate(10)
                    ->withQueryString();



        $data = [
            "products" => $products,
            "filteredValue" => $params
        ];
        return Inertia::render('Product/Index', $data);
    }

    public function create()
    {
        $currencies = Currency::latest()->get();

        $data = [
            "currencies" => $currencies
        ];

        return Inertia::render('Product/Create', $data);
    }

    public function store(StoreProductRequest $request)
    {
        try {

            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity_available = $request->quantity_available;
            $product->currency_id = $request->currency_id;
            $product->user_id = Auth::id();
            $product->save();

            return redirect()->route('admin.products.index')->with("status",["flag" => "success", "msg" => $product->name .' have been saved successfully']);


        } catch (\Throwable $e){
            return redirect()->route('admin.products.index')->with("status",["flag" => "error", "msg" => $e->getMessage()]);
        }
    }

    public function edit(Product $product)
    {
        $currencies = Currency::latest()->get();

        $data = [
            "currencies" => $currencies,
            "product" => $product
        ];

        return Inertia::render('Product/Edit', $data);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {

            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity_available = $request->quantity_available;
            $product->currency_id = $request->currency_id;
            $product->user_id = Auth::id();
            $product->update();

            return redirect()->route('admin.products.index')->with("status",["flag" => "success", "msg" => $product->name .' have been updated successfully']);


        } catch (\Throwable $e){
            return redirect()->route('admin.products.index')->with("status",["flag" => "error", "msg" => $e->getMessage()]);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->back()->with("status",["flag" => "success", "msg" => $product->name .' have been deleted successfully']);


        } catch (\Throwable $e){
            return redirect()->back()->with("status",["flag" => "error", "msg" => $e->getMessage()]);
        }
    }

    public function checkout(Request $request, Product $product)
    {
        DB::beginTransaction();
        try {

            $quantity = $request->quantity;
            $totalPrice = $request->totalPrice;
            $remainingQuantity = $product->quantity_available - $quantity;

            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->product_id = $product->id;
            $transaction->quantity = $quantity;
            $transaction->total_price = $totalPrice;
            $transaction->save();

            $product->quantity_available = $remainingQuantity;
            $product->update();

            DB::commit();

            return redirect()->route('productCheckout', $product->id)->with("status",["flag" => "success", "msg" => 'Checkout Success!']);


        } catch (\Throwable $e){
            DB::rollBack();

            return redirect()->route('productCheckout', $product->id)->with("status",["flag" => "error", "msg" => $e->getMessage()]);
        }



    }
}
