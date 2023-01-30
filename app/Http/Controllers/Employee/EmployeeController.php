<?php

namespace App\Http\Controllers\Employee;

use App\Models\User;
use App\Models\Employee;
use App\Models\EmployeeAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Traits\UploadImageTrait;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::Selection()->latest()->paginate(12);
        $users = User::Selection()->active()->get();
        return view('pages.employees.index',compact('employees', 'users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $employees = Employee::onlyTrashed()->latest()->paginate(12);
        return view('pages.employees.trash', compact('employees'));
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
    public function store(AddEmployeeRequest $request)
    {
        try {

            if ($request->has('personal_id'))
                $request->request->add(['personal_id' => str_replace(' ', '', filter_var($request->personal_id, FILTER_SANITIZE_NUMBER_INT))]);

            if ($request->has('mobile'))
                $request->request->add(['mobile' => str_replace(['-', '(', ')', ' '], '', filter_var($request->mobile, FILTER_SANITIZE_NUMBER_INT))]);

            $validatedData = $request->validate([
                'personal_id' => ['unique:employees,personal_id' ],
                'mobile' => ['unique:employees,mobile'],
            ]);

            if (!$request->has('status'))
                $request->request->add(['status' => false]);
            else
                $request->request->add(['status' => true]);

            $image_path = $this->uploadImage($request, 'image' ,'employees');

            Employee::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'qualification' => $request->qualification,
                'address' => $request->address,
                'job_description' => $request->job_description,
                'job' => $request->job,
                'personal_id' => $request->personal_id,
                'gender' => $request->gender,
                'image' => $image_path,
                'mobile' => $request->mobile,
                'dirth_date' => $request->dirth_date,
                'salary' => $request->salary,
                'commission_percentage' => $request->commission_percentage,
                'join_date' => $request->join_date,
                'user_id' => $request->user_id,
                'status' => $request->status,
                'created_by' => (Auth::user()->id),
            ]);

            session()->flash('Store','تم الأضافة بنجاح');
            return redirect()->route('employees');

        } catch (\Exception $ex) {

            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::selection()->find($id) ?? Employee::onlyTrashed()->find($id);

        if(! $employee){
            session()->flash('error','لا يوجد عنصر بهذا الرقم');
            return redirect()->back();
        }

        return view('pages.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request)
    {
        try {
            $employee = Employee::selection()->find($request->id);

            if(! $employee){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            if ($request->has('personal_id'))
                $request->request->add(['personal_id' => str_replace(' ', '', filter_var($request->personal_id, FILTER_SANITIZE_NUMBER_INT))]);

            if ($request->has('mobile'))
                $request->request->add(['mobile' => str_replace(['-', '(', ')', ' '], '', filter_var($request->mobile, FILTER_SANITIZE_NUMBER_INT))]);

            // $validatedData = $request->validate([
            //     'personal_id' => [Rule::unique(Employee::class,'personal_id')->ignore($request->id)],
            //     'mobile' => [Rule::unique(Employee::class,'mobile')->ignore($request->id)],
            // ]);

            if (!$request->has('status'))
                $request->request->add(['status' => false]);
            else
                $request->request->add(['status' => true]);

            $oldImage =  $employee->image != null ? $employee->image : '';
            $image_path = $this->uploadImage($request, 'image' , 'employees', $oldImage );


            $requestData = $request->all();
            $requestData['image'] = $image_path;

            $employee->update($requestData);

            session()->flash('Update','تم التعديل بنجاح');
            return redirect()->route('employees');

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

            $employee = Employee::withTrashed()->find($request->id);

            if(! $employee){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            if ($employee->image)
                $this->deleteImage($employee->image );

            $employee->forceDelete();

            session()->flash('Destroy','تم الحذف بنجاح');
            return redirect()->route('employees.trash');

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

            $employee = Employee::selection()->find($id);

            if(! $employee){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $employee->delete();

            session()->flash('SoftDelete','تم الأرشفة بنجاح');
            return redirect()->route('employees');

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

            $employee = Employee::withTrashed()->find($id);

            if(! $employee){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $employee->restore();

            session()->flash('Restore','تم الأسترجاع بنجاح');
            return redirect()->route('employees');

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

            $employee = Employee::selection()->find($id);

            if(! $employee){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $employee->update([ 'status' => true]);

            session()->flash('Active','تم التفعيل بنجاح');
            return redirect()->route('employees');

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

            $employee = Employee::selection()->find($id);


            if(! $employee){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $employee->update([ 'status' => false]);

            session()->flash('Deactive','تم إلغاء التفعيل بنجاح');
            return redirect()->route('employees');

       }catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
       }

    }

}
