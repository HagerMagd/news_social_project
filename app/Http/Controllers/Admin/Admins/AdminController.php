<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admindashboard\AdminRequest;
use App\Models\Admin;
use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_by = request()->order_by ?? 'asc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;
        $admins = Admin::where('id','!=',auth('admin')->id())->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('email', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })->orderBy($sort_by, $order_by)
            ->paginate(request($limit_by));
            $authorizations = Authorization::select('id','role')->get();


        return view('dashbord.adminauth.admins.index', compact('admins','authorizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authorizations=Authorization::select('id','role')->get();
        return view('dashbord.adminauth.admins.create',compact('authorizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->except('_token')
           );
        if ($admin) {
            session::flash('success', "Admin Created successfully ! ");
        }else{
            session::flash('error', "Please Try Again ! ");
        }
        return redirect()->route('admin.admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin=Admin::findOrFail($id);
        $authorizations=Authorization::select('id','role')->get();
        return view('dashbord.adminauth.admins.edit',compact('authorizations','admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin=Admin::findOrFail($id);
        $admin_update= $admin->update($request->except('_token'));

        if ($admin_update) {
            session::flash('success', "Admin updated successfully ! ");
        }else{
            session::flash('error', "Please Try Again ! ");
        }
        return redirect()->route('admin.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        Session::flash('success', "$admin->name Deleted Successuflly");
        return redirect()->route('admin.admin.index');
    }
    public function AdminStatus($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->status == 1) {
            $admin->update(['status' => 0]);
            Session::flash('success', "$admin->name Blocked Successuflly");
        } else {
            $admin->update(['status' => 1]);
            Session::flash('success', "$admin->name Active Successuflly");
        }
        return redirect()->route('admin.admin.index');
    }
}
