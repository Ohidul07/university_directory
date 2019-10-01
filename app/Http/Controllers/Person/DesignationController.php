<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
// use App\Models\bsmrau\Category;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $designations = DB::table('designations')->where('deleted_at',null)->paginate(15);
        if ($request->ajax()) {
            return view('person.designation.list_view',compact('designations'));
        }
        return view('person.designation.list',compact('designations'));
    }

    public function store(Request $request){
        $exist = DB::table('designations')->where('name',$request->get('name'))->where('deleted_at',null)->first();
        if($exist){
            return 'exist';
        }
        $result = DB::table('designations')->insert([
            'name' => $request->get('name'),
            'created_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function edit($id){
        $designation = DB::table('designations')->where('id',$id)->get();
        return $designation;
    }

    public function update(Request $request){
        $exist = DB::table('designations')->where('name',$request->get('name'))->where('deleted_at',null)->where('id','!=',$request->get('id'))->first();
        if($exist){
            return 'exist';
        }
        $result = DB::table('designations')->where('id',$request->get('id'))->update([
            'name' => $request->get('name'),
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function destroy($id){
        $result = DB::table('designations')->where('id',$id)->update([
            'deleted_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function active($id){
        $result = DB::table('designations')->where('id',$id)->update([
            'active' => 1,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function deactive($id){
        $result = DB::table('designations')->where('id',$id)->update([
            'active' => 0,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }
}
