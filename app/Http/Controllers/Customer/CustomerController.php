<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Traits\UploadImageTrait;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::Selection()->latest()->paginate(12);
        $users = User::Selection()->active()->get();
        return view('pages.customers.index',compact('customers', 'users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $customers = Customer::onlyTrashed()->latest()->paginate(12);
        return view('pages.customers.trash', compact('customers'));
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
    public function store(AddCustomerRequest $request)
    {
        try {

            if ($request->has('personal_id'))
                $request->request->add(['personal_id' => str_replace(' ', '', filter_var($request->personal_id, FILTER_SANITIZE_NUMBER_INT))]);

            if ($request->has('mobile'))
                $request->request->add(['mobile' => str_replace(['-', '(', ')', ' '], '', filter_var($request->mobile, FILTER_SANITIZE_NUMBER_INT))]);

            $validatedData = $request->validate([
                'personal_id' => ['unique:customers,personal_id' ],
                'mobile' => ['unique:customers,mobile'],
            ]);

            if (!$request->has('status'))
                $request->request->add(['status' => false]);
            else
                $request->request->add(['status' => true]);

            $image_path = $this->uploadImage($request, 'image' ,'customers');

            Customer::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'job' => $request->job,
                'personal_id' => $request->personal_id,
                'gender' => $request->gender,
                'image' => $image_path,
                'mobile' => $request->mobile,
                'dirth_date' => $request->dirth_date,
                'user_id' => $request->user_id,
                'status' => $request->status,
                'created_by' => (Auth::user()->id),
            ]);

            session()->flash('Store','تم الأضافة بنجاح');
            return redirect()->route('customers');

        } catch (\Exception $ex) {

            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::selection()->find($id) ?? Customer::onlyTrashed()->find($id);

        if(! $customer){
            session()->flash('error','لا يوجد عنصر بهذا الرقم');
            return redirect()->back();
        }

        return view('pages.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request)
    {
        try {
            $customer = Customer::selection()->find($request->id);

            if(! $customer){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            if ($request->has('personal_id'))
                $request->request->add(['personal_id' => str_replace(' ', '', filter_var($request->personal_id, FILTER_SANITIZE_NUMBER_INT))]);

            if ($request->has('mobile'))
                $request->request->add(['mobile' => str_replace(['-', '(', ')', ' '], '', filter_var($request->mobile, FILTER_SANITIZE_NUMBER_INT))]);

            $validatedData = $request->validate([
                'personal_id' => [Rule::unique(Customer::class,'personal_id')->ignore($request->id)],
                'mobile' => [Rule::unique(Customer::class,'mobile')->ignore($request->id)],
            ]);

            if (!$request->has('status'))
                $request->request->add(['status' => false]);
            else
                $request->request->add(['status' => true]);

            $oldImage =  $customer->image != null ? $customer->image : '';
            $image_path = $this->uploadImage($request, 'image' , 'customers', $oldImage );


            $requestData = $request->all();
            $requestData['image'] = $image_path;

            $customer->update($requestData);


            session()->flash('Update','تم التعديل بنجاح');
            return redirect()->route('customers');

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

            $customer = Customer::withTrashed()->find($request->id);

            if(! $customer){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            if ($customer->image)
                $this->deleteImage($customer->image );

            $customer->forceDelete();

            session()->flash('Destroy','تم الحذف بنجاح');
            return redirect()->route('customers.trash');

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

            $customer = Customer::selection()->find($id);

            if(! $customer){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $customer->delete();

            session()->flash('SoftDelete','تم الأرشفة بنجاح');
            return redirect()->route('customers');

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

            $customer = Customer::withTrashed()->find($id);

            if(! $customer){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $customer->restore();

            session()->flash('Restore','تم الأسترجاع بنجاح');
            return redirect()->route('customers');

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

            $customer = Customer::selection()->find($id);

            if(! $customer){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $customer->update([ 'status' => true]);

            session()->flash('Active','تم التفعيل بنجاح');
            return redirect()->route('customers');

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

            $customer = Customer::selection()->find($id);


            if(! $customer){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $customer->update([ 'status' => false]);

            session()->flash('Deactive','تم إلغاء التفعيل بنجاح');
            return redirect()->route('customers');

       }catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
       }

    }

}
