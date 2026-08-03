<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admindashboard\AuthorizationRequest;
use App\Models\Authorization;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_by = request()->order_by ?? 'asc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;
        $roles = Authorization::when(request()->keyword, function ($query) {
            $query->where('role', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('permession', 'LIKE', '%' . request()->keyword . '%');
        })
            ->orderBy($sort_by, $order_by)
            ->paginate(($limit_by));

      

        return view('dashbord.adminauth.system_role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.adminauth.system_role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {
        Authorization::create([
            'role' => $request->role,
            'permession' => $request->permession, 
        ]);

        return redirect()->back()->with('success', 'New Role Added successfully!');
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
        $role = Authorization::findorFail($id);
        
        return view('dashbord.adminauth.system_role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorizationRequest $request, string $id)
    {
        $authorization=Authorization::findOrFail($id);
        $authorization->update([ 
             'role' => $request->role,
            'permession' => $request->permession, 
]);
           
        return redirect()->route('admin.authorization.index')->with('success', 'New Role Upadted successfully!');

    


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     $role=Authorization::findorFail($id);
     if($role->admins()->count()>0 ){
        return redirect()->back()->with('error', 'Please delete related admins for this role first !'); 
     }
    if(!$role->delete()){
    return redirect()->route('admin.authorization.index')
    ->with('error','Try Again') ;
   }
    else{
    return redirect()->route('admin.authorization.index')
    ->with('success','Role Deleted Seccessfully !');
    }
}
}