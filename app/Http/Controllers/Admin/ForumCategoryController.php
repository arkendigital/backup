<?php

namespace App\Http\Controllers\Admin;

use App\ForumCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ForumCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create forum category|edit forum category|delete forum category']);
    }

    public function create(Role $role)
    {
        $roles = $role->all();
        return view('admin.forums.categories.create', compact('roles'));
    }

    public function store(Request $request, ForumCategory $category)
    {
        $category->fill($request->only(['name', 'position', 'roles']));
        $category->save();
        alert()->success('Category Created');

        return redirect()->route('forums.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumCategory $category, Role $role)
    {
        $roles = $role->all();
        return view('admin.forums.categories.edit', compact('category', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ForumCategory $category)
    {
        if ($request->roles == null) {
            $roles = [];
        } else {
            $roles = $request->roles;
        }

        $category->update($request->all());
        $category->update(['roles' => $roles]);

        alert()->success('Category Updated!');

        return redirect()->route('forums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ForumCategory $category)
    {
        foreach ($category->forums as $forum) {
            $forum->delete();
        }

        $category->delete();

        alert()->success('Category Deleted!');

        return redirect()->route('forums.index');
    }
}
