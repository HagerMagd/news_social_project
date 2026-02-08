<?php

namespace App\Http\Controllers\Admin\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admindashboard\UserRequset;
use App\Models\User;
use App\utlis\ImagesManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;
        $users = User::when(request()->keyword, function ($query) {

            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('email', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })->orderBy($sort_by, $order_by)
            ->paginate(request($limit_by));
        return view('dashbord.adminauth.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.adminauth.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequset $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $request->merge([
                'email_verified_at' => $request->email_verified_at == 1 ? now() : null,
            ]);
            $user = User::create($request->except(['_token', 'password_confirmation', 'image']));
            ImagesManger::uploadImages($request, null, $user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        Session::flash('success', "$user->name Created Successuflly");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=User::findOrFail($id);
        return view('dashbord.adminauth.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        //delete user image from local befor delete user 
        ImagesManger::checkFileAndDelete($user->image);
        $user->delete();
        Session::flash('success', "$user->name Deleted Successuflly");
        return redirect()->route('admin.users.index');
    }
    public function UserStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->update(['status' => 0]);
            Session::flash('success', "$user->name Blocked Successuflly");
        } else {
            $user->update(['status' => 1]);
            Session::flash('success', "$user->name Active Successuflly");
        }
        return redirect()->back();
    }
}
