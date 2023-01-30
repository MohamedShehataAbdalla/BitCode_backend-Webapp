<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Section;
use App\Models\Trademark;
use Illuminate\Http\Request;
use Nicolaslopezj\Searchable\SearchableTrait;

class EcommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // if($request->keyword != null)
        // {
        //     dd($request->all());
        // }

        $keyword = $request->has('keyword') ? $request->get('keyword') : null;
        $selected_price = null;
        $selected_section =  null;
        $selected_trademark =  null;
        $selected_unit =  null;
        $selected_tags = [];

        $tags = Tag::Selection()->active()->orderby('name')->get();
        $units = Unit::Selection()->active()->orderby('name')->get();
        $sections = Section::Selection()->active()->orderby('name')->get();
        $trademarks = Trademark::Selection()->active()->orderby('name')->get();

        $products = Product::Selection()->Active()->with(['section', 'tags', 'trademark', 'unit']);


        if ($keyword != null){
            // $products = $products->search($request->keyword);
            $products = $products->where(function ($query) use ($request) {
                $query->orWhere('name', 'like', '%' . $request->keyword . '%');
                $query->orWhere('description', 'like', '%' . $request->keyword . '%');
                $query->orWhere('barcode', 'like', '%' . $request->keyword . '%');
                $query->orWhere('price', 'like', '%' . $request->keyword . '%');
            });
        }

        if (isset($_POST['filtering'])) {

            $selected_price = $request->has('price') ? $request->get('price') : null;
            $selected_section = $request->has('section') ? $request->get('section') : null;
            $selected_trademark = $request->has('trademark') ? $request->get('trademark') : null;
            $selected_unit = $request->has('unit') ? $request->get('unit') : null;
            $selected_tags = $request->has('tags') ? $request->get('tags') : [];

            if ($selected_price != null) {
                $products = $products->when($selected_price, function ($query) use ($selected_price){
                    if ($selected_price == 'price_0_500') {
                        $query->whereBetween('price', [0, 500]);
                    } elseif ($selected_price == 'price_501_2500') {
                        $query->whereBetween('price', [501, 2500]);
                    } elseif ($selected_price == 'price_2501_6000') {
                        $query->whereBetween('price', [2501, 6000]);
                    } elseif ($selected_price == 'price_6001_12000') {
                        $query->whereBetween('price', [6001, 12000]);
                    }elseif ($selected_price == 'price_12001') {
                        $query->where('price', '>', 12001);
                    }
                });
            }
    
            if ($selected_section != null) {
                $products = $products->whereSectionId($selected_section);
            }
    
            if ($selected_unit != null) {
                $products = $products->whereUnitId($selected_unit);
            }
    
            if ($selected_trademark != null) {
                $products = $products->whereTrademarkId($selected_trademark);
            }
    
            if (is_array($selected_tags) && count($selected_tags) > 0) {
                $products = $products->whereHas('tags', function ($query) use ($selected_tags) {
                    $query->whereIn('product_tag.tag_id', $selected_tags);
                });
            }

        }
        

        $products = $products->orderByDesc('created_at');
        $products = $products->paginate(12);

        return view('pages.ecommerce.index',compact('products', 'units', 'sections', 'trademarks', 'tags', 'keyword', 'selected_price', 'selected_section', 'selected_trademark', 'selected_unit', 'selected_tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::selection()->find($id);

        if(! $product){
            session()->flash('error','لا يوجد عنصر بهذا الرقم');
            return redirect()->back();
        }

        $suggested_products = Product::selection()->where( 'id', '!=', $product->id)->where('name', 'like', '%' . $product->name . '%')->orWhere('description', 'like', '%' . $product->name . '%')->limit(4)->get();;


        return view('pages.ecommerce.show', compact('product', 'suggested_products'));
    }


}
