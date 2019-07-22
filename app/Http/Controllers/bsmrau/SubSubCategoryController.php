<?php

namespace App\Http\Controllers\bsmrau;

use Illuminate\Http\Request;
use App\Models\bsmrau\Category;
use App\Models\bsmrau\SubCategory;
use App\Models\bsmrau\SubSubCategory;
use App\Http\Controllers\Controller;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $subsubcategories = SubSubCategory::latest()->paginate(1);
        if ($request->ajax()) {
            return view('bsmrau.subsubcategory.list_view',compact('subsubcategories','categories'));
        }
        return view('bsmrau.subsubcategory.list',compact('subsubcategories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subsubcategory = new SubSubCategory();
        $subsubcategory->name = $request->name;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        if($subsubcategory->save()){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSubCategory($id)
    {
        $subcategories = SubCategory::where('category_id',$id)->orderBy('name','asc')->get();
        return $subcategories;

    }

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
        $subsubcategory = SubSubCategory::findOrFail($id);
        return $subsubcategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $subsubcategory = SubSubCategory::findOrFail($request->id);
        $subsubcategory->name = $request->name;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        if($subsubcategory->update()){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subsubcategory = SubSubCategory::findOrFail($id);
        if($subsubcategory->delete()){
            return 1;
        }
        else{
            return 0;
        }
    }
}
