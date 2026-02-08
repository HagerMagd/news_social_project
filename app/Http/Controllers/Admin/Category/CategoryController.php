<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admindashboard\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Contracts\Service\Attribute\Required;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $order_by = request()->order_by ?? 'asc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;
        $categories = Category::withCount('posts')->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })->orderBy($sort_by, $order_by)
            ->paginate(request($limit_by));

        return view('dashbord.adminauth.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.adminauth.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
       $category=Category::create($request->only(['name','status']));
       if(!$category){
        Session::flash('success', 'Try Again');
        return redirect()->route('admin.category.index');
       }else{
        Session::flash('success', 'Category Created Successuflly');
        return redirect()->route('admin.category.index');
       }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([ 'name'=>['required','min:2','max:50']]);
        $category=Category::findOrFail($id);
        $category=$category->update(['name'=>$request->name]);
        if(!$category){
            session::flash('error', ' Please Try Again ');
        }
        else{
            session::flash('success', 'Category UPdated Successuflly');
        }
        return redirect()->back();
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function CategoriesStatus($id)
    {
        $category = Category::findOrFail($id);
        if ($category->status == 1) {
            $category->update(['status' => 0]);
            session::flash('success', 'Category UnAvtive Successuflly');
        } else {
            $category->update(['status' => 1]);
            session::flash('success', 'Category Active Successuflly');
        }
        return redirect()->back();
    }
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();
        Session::flash('success', 'Category Deleted Successuflly');
        return redirect()->back();
    }
}
