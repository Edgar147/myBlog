<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Gate;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Password;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // dd('index methon on user Controller');

        $users=User::paginate(10); //users per  page
        if(Gate::denies('logged-in')){
            dd('no aceess allowed');
            // return view('superadmin.users.index')->with(['users'=>$users]);
            }

        if(Gate::allows('is-superadmin')){
        return view('superadmin.users.index',['users'=>$users]);
        // return view('superadmin.users.index')->with(['users'=>$users]);
        }
        dd('you need to be SuperAdmin');

        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

return view('superadmin.users.create',['roles'=>Role::all()]);




    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $newUser=new CreateNewUser();
        $user= $newUser->create($request->only('name','email','password','password_confirmation'));






        // dd($request);
        // $validatedData=$request->validated();
        
        $request->session()->flash('success','You have created the user');
        // $user=User::create($request->except(['_token','roles']));
        //  $user=User::create($validatedData);


        $user->roles()->sync($request->roles);// if only 1 role for application, we can use attach in the place of sync
        Password::sendResetLink($request->only(['email']));
        return redirect(route('superadmin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('superadmin.users.edit',
        
        [
            'roles'=>Role::all(),
            'user'=>User::find($id)
    
    ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $user=User::findOrFail($id);
        $user=User::find($id);
        if(!$user){        $request->session()->flash('error','You cannot edit this user.');
            return redirect(route('superadmin.users.index'));

        }



        $request->session()->flash('success','You have edited the user');

        // $user->update($request->except(['_token','roles']));
        $user->update($request->except(['_token','roles']));
        $user->roles()->sync($request->roles);
        return redirect(route('superadmin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //
        // dd($id);
        User::destroy($id);
        $request->session()->flash('success','You have deleted the user');
        return redirect(route('superadmin.users.index'));

    }
}
