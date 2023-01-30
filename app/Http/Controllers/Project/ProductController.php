<?php

namespace App\Http\Controllers\Project;

use App\Models\Tag;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Section;
use App\Models\Trademark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\UploadImageTrait;

class ProjectController extends Controller
{
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::Selection()->latest()->paginate(12);
        // $products = Product::Selection()->with('category', 'tags')->latest()->paginate(12);
        $tags = Tag::Selection()->active()->orderby('name')->get();
        $units = Unit::Selection()->active()->orderby('name')->get();
        $sections = Section::Selection()->active()->orderby('name')->get();
        $trademarks = Trademark::Selection()->active()->orderby('name')->get();
        return view('pages.products.index',compact('products', 'units', 'sections', 'trademarks', 'tags'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $products = Product::onlyTrashed()->latest()->paginate(12);
        return view('pages.products.trash', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try {

            if (!$request->has('status'))
                $request->request->add(['status' => false]);
            else
                $request->request->add(['status' => true]);

            $image_path = $this->uploadImage($request, 'image' ,'products');

            $product = Product::create([
                'name' => $request->name,
                'barcode' => $request->barcode,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => $request->discount,
                'section_id' => $request->section_id,
                'unit_id' => $request->unit_id,
                'trademark_id' => $request->trademark_id,
                'image' => $image_path,
                'status' => $request->status,
                'created_by' => (Auth::user()->id),
            ]);

            $product->tags()->attach($request->tags);

            session()->flash('Store','تم الأضافة بنجاح');
            return redirect()->route('products');

        } catch (\Exception $ex) {

            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::selection()->find($id) ?? Product::onlyTrashed()->find($id);

        if(! $product){
            session()->flash('error','لا يوجد عنصر بهذا الرقم');
            return redirect()->back();
        }

        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        try {
            $product = Product::selection()->find($request->id);

            if(! $product){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }
            if (!$request->has('status'))
                $request->request->add(['status' => false]);
            else
                $request->request->add(['status' => true]);

            $oldImage =  $product->image != null ? $product->image : '';
            $image_path = $this->uploadImage($request, 'image' , 'products', $oldImage );

            $requestData = $request->all();
            $requestData['image'] = $image_path;

            $product->update($requestData);

            $product->tags()->sync($request->tags);

            session()->flash('Update','تم التعديل بنجاح');
            return redirect()->route('products');

        } catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            $product = Product::withTrashed()->find($request->id);

            if(! $product){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            if ($product->image)
                $this->deleteImage($product->image );

            $product->forceDelete();

            session()->flash('Destroy','تم الحذف بنجاح');
            return redirect()->route('products.trash');

        }catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
       try {

            $product = Product::selection()->find($id);

            if(! $product){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $product->delete();

            session()->flash('SoftDelete','تم الأرشفة بنجاح');
            return redirect()->route('products');

        }catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {

            $product = Product::withTrashed()->find($id);

            if(! $product){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $product->restore();

            session()->flash('Restore','تم الأسترجاع بنجاح');
            return redirect()->route('products');

       }catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
       }

    }

     /**
     * Active the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        try {

            $product = Product::selection()->find($id);

            if(! $product){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $product->update([ 'status' => true]);

            session()->flash('Active','تم التفعيل بنجاح');
            return redirect()->route('products');

       }catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
       }

    }

    /**
     * Inactive the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function deactive($id)
    {
        try {

            $product = Product::selection()->find($id);


            if(! $product){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $product->update([ 'status' => false]);

            session()->flash('Deactive','تم إلغاء التفعيل بنجاح');
            return redirect()->route('products');

       }catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
       }

    }

}
