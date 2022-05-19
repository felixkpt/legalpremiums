<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @param string $image_rules
     */
    private $image_rules = 'mimes:jpg,png,jpeg,gif|min:2|max:2024|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000';
    private $perPage = 15;
    private $route = 'admin.categories';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate($this->perPage);
        $data = ['categories' => $categories];
        return view('admin/categories/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin/categories/create', ['route' => $this->route.'.index', 'method' => 'post', 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $slug = Str::of($request->get('slug') ?? $name)->slug('-')->value();
        $rules = [
            'name' => 'required|max:100|unique:categories,name',
            'slug' => 'max:100|unique:categories,slug',
            'parent' => 'integer',
        ];
        if ($request->hasFile('image')) {
            $rules = array_merge($rules, ['image' => $this->image_rules]);
        }
        $request->validate($rules);
        
        $description = $request->get('description');
        $data = ['name' => $name, 'slug' => $slug, 'description' => $description, 'parent' => $request->get('parent')];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/'.date('Y').'/'.date('m').'/categories');
            $path = preg_replace('#public/#', 'uploads/', $path);
            $data['image'] = $path;
        }

        Category::create($data);
        return redirect()->to($request->get('redirect'))->with('success', 'Category created');

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
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view($this->route.'.edit', ['route' => $this->route.'.update', 'method' => 'patch', 'category' => $category, 'categories' => $categories]);

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

        $name = $request->get('name');
        $slug = Str::of($request->get('slug') ?? $name)->slug('-')->value();
        $rules = [
            'name' => 'required|max:100|unique:categories,name,'.$request->id,
            'slug' => 'max:100|unique:categories,slug,'.$request->id,
            'parent' => 'integer',
        ];
        if ($request->hasFile('image')) {
            $rules = array_merge($rules, ['image' => $this->image_rules]);
        }
        $request->validate($rules);
        
        $description = $request->get('description');
    
        $data = ['name' => $name, 'slug' => $slug, 'description' => $description, 'parent' => $request->get('parent')];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/'.date('Y').'/'.date('m').'/categories');
            $path = preg_replace('#public/#', 'uploads/', $path);
            $data['image'] = $path;
        }

        Category::find($id)->update($data);
        return redirect()->to($request->get('redirect'))->with('success', 'Category updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Category::find($request->get('id'))->delete();
        return redirect()->back()->with('danger', 'Category deleted');
    }
}
