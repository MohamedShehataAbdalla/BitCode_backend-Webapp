<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Traits\UploadImageTrait;
use DB;
use Hash;

class UserController extends Controller
{
    use UploadImageTrait;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $users = User::Selection()->latest()->paginate(12);
        $roles = Role::pluck('name','name')->all();
        return view('pages.users.index',compact('users', 'roles'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $users = User::onlyTrashed()->latest()->paginate(5);
        $roles = Role::pluck('name','name')->all();
        return view('pages.users.trash', compact('users', 'roles'));
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('pages.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        try {

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            $image_path = $this->uploadImage($request, 'profile_photo_path' ,'users');

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['created_by'] = (Auth::user()->id);
            $input['profile_photo_path'] = $image_path;

            // return $request;

            $user = User::create($input);
            $user->assignRole($request->input('roles_name'));


            session()->flash('Store','تم الأضافة بنجاح');
            return redirect()->route('users');

        } catch (\Exception $ex) {

            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }
    }

    // public function store(Request $request)
    // {
        // $this->validate($request, [
        // 'name' => 'required',
        // 'email' => 'required|email|unique:users,email',
        // 'password' => 'required|same:confirm-password',
        // 'roles_name' => 'required'
        // ]);
        // $input = $request->all();
        // $input['password'] = Hash::make($input['password']);
        // $user = User::create($input);
        // $user->assignRole($request->input('roles_name'));
        // return redirect()->route('users.index')->with('success','تم اضافة المستخدم بنجاح');
    // }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::selection()->find($id);

        if(! $user){
            session()->flash('error','لا يوجد عنصر بهذا الرقم');
            return redirect()->back();
        }

        return view('pages.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::selection()->find($id);

        if(! $user){
            session()->flash('error','لا يوجد عنصر بهذا الرقم');
            return redirect()->back();
        }

        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('pages.users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::selection()->find($id);

            if(! $user){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            $oldImage =  $user->profile_photo_path != null ? $user->profile_photo_path : '';
            $image_path = $this->uploadImage($request, 'profile_photo_path' , 'users', $oldImage );

            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }
            $input['profile_photo_path'] = $image_path;

            $user->update($input);
            DB::table('model_has_roles')->where('model_id',$id)->delete();

            $user->assignRole($request->input('roles_name'));

            session()->flash('Update','تم التعديل بنجاح');
            return redirect()->route('users');

        } catch (\Exception $ex) {

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
    public function destroy(Request $request)
    {
        try {

            $user = User::withTrashed()->find($request->id);

            if(! $user){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }
            
            if ($user->profile_photo_path)
                $this->deleteImage($user->profile_photo_path );
            
            $user->forceDelete();

            session()->flash('Destroy','تم الحذف بنجاح');
            return redirect()->route('users.trash');

       }catch (\Exception $ex) {

            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guardian  $classroom
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
       try {

            $user = User::selection()->find($id);

            if(! $user){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }
            
            $user->delete();

            session()->flash('SoftDelete','تم الأرشفة بنجاح');
            return redirect()->route('users');

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

            $user = User::withTrashed()->find($id);

            if(! $user){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }
            
            
            $user->restore();

            session()->flash('Restore','تم الأسترجاع بنجاح');
            return redirect()->route('users');

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

            $user = User::selection()->find($id);

            if(! $user){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $user->update([ 'status' => 1]);

            session()->flash('Active','تم التفعيل بنجاح');
            return redirect()->route('users');

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

            $user = User::selection()->find($id);

            if(! $user){
                session()->flash('error','لا يوجد عنصر بهذا الرقم');
                return redirect()->back();
            }

            $user->update([ 'status' => 0]);

            session()->flash('Deactive','تم إلغاء التفعيل بنجاح');
            return redirect()->route('users');

       }catch (\Exception $ex) {

            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

       }

    }

}
