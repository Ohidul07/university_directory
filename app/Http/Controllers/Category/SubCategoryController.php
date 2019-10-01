<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
// use App\Models\bsmrau\Category;
// use App\Models\bsmrau\SubCategory;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = DB::table('categories')->where('active',1)->where('deleted_at',null)->get();
        $sub_categories = DB::table('sub_categories')
            ->leftJoin('categories','categories.id','=','sub_categories.category_id')
            ->where('sub_categories.deleted_at',null)
            ->select('sub_categories.*','categories.name as category_name')
            ->get();
        if ($request->ajax()){
            return view('bsmrau.sub_category.list_view',compact('sub_categories','categories'));
        }
        return view('bsmrau.sub_category.list',compact('sub_categories','categories'));
    }

    public function store(Request $request){
        $exist = DB::table('sub_categories')->where('name',$request->get('name'))->where('deleted_at',null)->first();
        if($exist){
            return 'exist';
        }
        $result = DB::table('sub_categories')->insert([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'created_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function edit($id){
        $sub_category = DB::table('sub_categories')->where('id',$id)->get();
        return $sub_category;
    }

    public function update(Request $request){
        $exist = DB::table('sub_categories')->where('name',$request->get('name'))->where('deleted_at',null)->where('id','!=',$request->get('id'))->first();
        if($exist){
            return 'exist';
        }
        $result = DB::table('sub_categories')->where('id',$request->get('id'))->update([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function destroy($id){
        $result = DB::table('sub_categories')->where('id',$id)->update([
            'deleted_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function active($id){
        $result = DB::table('sub_categories')->where('id',$id)->update([
            'active' => 1,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function deactive($id){
        $result = DB::table('sub_categories')->where('id',$id)->update([
            'active' => 0,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }
}
