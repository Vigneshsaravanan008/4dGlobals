<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Mail\EmployeeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function export()
    {
       
        return Excel::download(new EmployeeExport(), 'Employee.csv');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone_no' => 'nullable|unique:users',
            'department_id' => 'required',
            'role_id' => 'required',
        ]);

        User::create([
            'emp_id' => 'US4D' . substr(str_shuffle('0123456789'), 1, 2),
            'name' => request('name'),
            'email' => request('email'),
            'phone_no' => request('phone_no'),
            'department_id' => request('department_id'),
            'role_id' => request('role_id'),
            'password' => bcrypt($request->get('password')),
        ]);
        return redirect()->route('home');
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
        $user = User::where('id', $id)->first();
        return view('website.user.edit', compact('user'));
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
        $this->validate($request, [
            'name' => 'required',
            'phone_no' => 'nullable|unique:users,phone_no,' . $id,
            'email' => 'nullable|unique:users,email,' . $id,
            'department_id' => 'required',
            'role_id' => 'required',
        ]);

        User::where('id',$id)->update([
            'name' => request('name'),
            'email' => request('email'),
            'phone_no' => request('phone_no'),
            'department_id' => request('department_id'),
            'role_id' => request('role_id'),
        ]);
        return redirect()->route('home');
    }

    public function search(Request $request)
    {
        $query_string= http_build_query(request()->all());
        if(request('name')==null && request('emp_id')==null)
        {
            return redirect()->back();
        }

        $users=User::orderBy('id','desc');
        $name='';
        $emp_id='';
        if($request->name!=null)
        {
            $name=request('name');
            $users->where('name','LIKE','%'.request('name').'%')->get();
        }

        if($request->emp_id!=null)
        {
            $emp_id=request('emp_id');
            $users->where('emp_id',request('emp_id'))->get();
        }

        $users=$users->paginate(10);

        return view('home',compact('emp_id','name','query_string','users'));
    }

    public function email()
    {
        $user=User::where('id',1)->first();
        Mail::to($user->email)->send(new EmployeeMail());
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('home');
    }
}
