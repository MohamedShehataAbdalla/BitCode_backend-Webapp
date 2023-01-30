<?php

namespace App\Http\Controllers\Section;

use App\Models\Section;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Traits\UploadImageTrait;

class SectionController extends Controller
{
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::Selection()->latest()->paginate(12);
        $parent_sections = Section::Selection()->active()->get();
        return view('pages.sections.index',compact('sections', 'parent_sections'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $sections = Section::onlyTrashed()->latest()->paginate(12);
        return view('pages.sections.trash', compact('sections'));
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

        try {

            if (!$request->has('status'))
                $request->request->add(['status' => false]);
            else
                $request->request->add(['status' => true]);

            $image_path = $this->uploadImage($request, 'image' ,'sections');

            Section::create([
                'name' => $request->name,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'image' => $image_path,
                'status' => $request->status,
                'created_by' => (Auth::user()->id),
            ]);

            session()->flash('Store','تم الأضافة بنجاح');
            return redirect()->route('sections');

        } catch (\Exception $ex) {

            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::selection()->find($id) ?? Section::onlyTrashed()->find($id);

        if(! $section){
            session()->flash('error','لا يوجد عنصر بهذا الرقم');
            return redirect()->back();
        }

        $children_sections = Section::selection()->find($id) != null ? 
                            Section::selection()->find($id)->children()->get() : 
                            Section::onlyTrashed()->find($id)->children()->get();
        $products = Product::selection()->where('section_id', $id)->get();
        return view('pages.sections.show', compact('section', 'children_sections', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        try {
            $section = Section::selection()->find($request->id);

            if(! $section){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            if (!$request->has('status'))
                $request->request->add(['status' => false]);
            else
                $request->request->add(['status' => true]);

            $oldImage =  $section->image != null ? $section->image : '';
            $image_path = $this->uploadImage($request, 'image' , 'sections', $oldImage );

            $requestData = $request->all();
            $requestData['image'] = $image_path;

            $section->update($requestData);

            session()->flash('Update','تم التعديل بنجاح');
            return redirect()->route('sections');

        } catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        try {

            $section = Section::withTrashed()->find($request->id);

            if(! $section){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            if ($section->image)
                $this->deleteImage($section->image );

            $section->forceDelete();

            session()->flash('Destroy','تم الحذف بنجاح');
            return redirect()->route('sections.trash');

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

            $section = Section::selection()->find($id);

            if(! $section){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $children_sections = Section::selection()->find($id)->children()->get();

            foreach($children_sections as $children){
                $children->delete();
            }
            $section->delete();

            session()->flash('SoftDelete','تم الأرشفة بنجاح');
            return redirect()->route('sections');

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

            $section = Section::withTrashed()->find($id);

            if(! $section){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $section->restore();

            session()->flash('Restore','تم الأسترجاع بنجاح');
            return redirect()->route('sections');

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

            $section = Section::selection()->find($id);

            if(! $section){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $parent_sections = Section::selection()->find($id)->parent()->get();

            foreach($parent_sections as $parent){
                $parent->update([ 'status' => true]);
            }

            $section->update([ 'status' => true]);

            session()->flash('Active','تم التفعيل بنجاح');
            return redirect()->route('sections');

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

            $section = Section::selection()->find($id);
            

            if(! $section){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $children_sections = Section::selection()->find($id)->children()->get();

            foreach($children_sections as $children){
                $children->update([ 'status' => false]);
            }
            $section->update([ 'status' => false]);

            session()->flash('Deactive','تم إلغاء التفعيل بنجاح');
            return redirect()->route('sections');

       }catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
       }

    }

    public function getProducts($id)
    {
        // $products = Product::selection()->where("section_id", $id)->pluck( "_id", "name");
        $products = Product::selection()->where("section_id", $id)->get();
        return json_encode($products);
    }


    
}
