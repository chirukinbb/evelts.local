<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $model = Category::getModel();

        $model->title = $request->input('title');

        $model->save();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $model = Category::find($id);

        $model->title = $request->input('title');

        $model->save();

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->route('admin.categories.index');
    }
}
