<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
// use App\Models\bsmrau\Category;
// use App\Models\bsmrau\SubCategory;
// use App\Models\bsmrau\SubSubCategory;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $categories = DB::table('categories')->where('active',1)->where('deleted_at',null)->get();
        $sub_sub_categories = DB::table('sub_sub_categories')
            ->leftJoin('sub_categories','sub_categories.id','=','sub_sub_categories.sub_category_id')
            ->leftJoin('categories','categories.id','=','sub_categories.category_id')
            ->where('sub_sub_categories.deleted_at',null)
            ->select('sub_sub_categories.*','sub_categories.name as sub_category_name','categories.name as category_name')
            ->paginate(15);
        if ($request->ajax()) {
            return view('bsmrau.sub_sub_category.list_view',compact('sub_sub_categories','categories'));
        }
        return view('bsmrau.sub_sub_category.list',compact('sub_sub_categories','categories'));
    }

    public function getSubCategory($id){
        $subcategories = DB::table('sub_categories')->where('active',1)->where('deleted_at',null)->where('category_id',$id)->get();
        return $subcategories;
    }

    public function getSubSubCategory($id){
        $subsubcategories = DB::table('sub_sub_categories')->where('active',1)->where('deleted_at',null)->where('sub_category_id',$id)->get();
        return $subsubcategories;
    }

    public function store(Request $request){
        $exist = DB::table('sub_sub_categories')->where('name',$request->get('name'))->where('deleted_at',null)->first();
        if($exist){
            return 'exist';
        }
        $result = DB::table('sub_sub_categories')->insert([
            'name' => $request->get('name'),
            'sub_category_id' => $request->get('subcategory_id'),
            'created_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function edit($id){
        $data['sub_sub_category'] = DB::table('sub_sub_categories')
            ->leftJoin('sub_categories','sub_categories.id','=','sub_sub_categories.sub_category_id')
            ->where('sub_sub_categories.id',$id)
            ->select('sub_sub_categories.*','sub_categories.category_id')
            ->get();
        $data['sub_categories'] = DB::table('sub_categories')->where('category_id',$data['sub_sub_category'][0]->category_id)->where('active',1)->where('deleted_at',null)->get();
        return $data;
    }

    public function update(Request $request){
        $exist = DB::table('sub_sub_categories')->where('name',$request->get('name'))->where('deleted_at',null)->where('id','!=',$request->get('id'))->first();
        if($exist){
            return 'exist';
        }
        $result = DB::table('sub_sub_categories')->where('id',$request->get('id'))->update([
            'name' => $request->get('name'),
            'sub_category_id' => $request->get('subcategory_id'),
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function destroy($id){
        $result = DB::table('sub_sub_categories')->where('id',$id)->update([
            'deleted_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function active($id){
        $result = DB::table('sub_sub_categories')->where('id',$id)->update([
            'active' => 1,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function deactive($id){
        $result = DB::table('sub_sub_categories')->where('id',$id)->update([
            'active' => 0,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }
}
