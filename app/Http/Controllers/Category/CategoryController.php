<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
// use App\Models\bsmrau\Category;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $categories = DB::table('categories')->where('deleted_at',null)->get();
        if ($request->ajax()) {
            return view('bsmrau.category.list_view',compact('categories'));
        }
        return view('bsmrau.category.list',compact('categories'));
    }

    public function store(Request $request){
        $exist = DB::table('categories')->where('name',$request->get('name'))->where('deleted_at',null)->first();
        if($exist){
            return 'exist';
        }
        $result = DB::table('categories')->insert([
            'name' => $request->get('name'),
            'created_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function edit($id){
        $category = DB::table('categories')->where('id',$id)->get();
        return $category;
    }

    public function update(Request $request){
        $exist = DB::table('categories')->where('name',$request->get('name'))->where('deleted_at',null)->where('id','!=',$request->get('id'))->first();
        if($exist){
            return 'exist';
        }
        $result = DB::table('categories')->where('id',$request->get('id'))->update([
            'name' => $request->get('name'),
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function destroy($id){
        $result = DB::table('categories')->where('id',$id)->update([
            'deleted_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function active($id){
        $result = DB::table('categories')->where('id',$id)->update([
            'active' => 1,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function deactive($id){
        $result = DB::table('categories')->where('id',$id)->update([
            'active' => 0,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }
}
