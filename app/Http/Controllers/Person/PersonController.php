<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $persons = DB::table('persons')
            ->leftJoin('categories','categories.id','=','persons.category_id')
            ->leftJoin('sub_categories','sub_categories.id','=','persons.sub_category_id')
            ->leftJoin('sub_sub_categories','sub_sub_categories.id','=','persons.sub_sub_category_id')
            ->leftJoin('designations','designations.id','=','persons.designation_id')
            ->where('persons.deleted_at',null)
            ->select('persons.*','categories.name as category_name','sub_categories.name as sub_category_name','sub_sub_categories.name as sub_sub_category_name','designations.name as designation_name')
            ->paginate(15);
        $designations = DB::table('designations')->where('deleted_at',null)->where('active',1)->get();
        $categories = DB::table('categories')->where('deleted_at',null)->where('active',1)->get();

        if ($request->ajax()) {
            return view('person.person.list_view',compact('persons'));
        }
        return view('person.person.list',compact('persons','designations','categories'));
    }

    public function store(Request $request){
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imagefile = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/persons/', $imagefile);
            $image = '/persons/'.$imagefile;
        }
        $result = DB::table('persons')->insert([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'sub_category_id' => $request->get('sub_category_id'),
            'sub_sub_category_id' => $request->get('sub_sub_category_id'),
            'designation_id' => $request->get('designation_id'),
            'contact' => $request->get('contact'),
            'email' => $request->get('email'),
            'image' => $image,
            'created_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function edit($id){
        $data['person'] = DB::table('persons')->where('id',$id)->get();
        $data['sub_categories'] = DB::table('sub_categories')->where('deleted_at',null)->where('active',1)->where('category_id',$data['person'][0]->category_id)->get();
        $data['sub_sub_categories'] = DB::table('sub_sub_categories')->where('deleted_at',null)->where('active',1)->where('sub_category_id',$data['person'][0]->sub_category_id)->get();
        return $data;
    }

    public function update(Request $request){
        $exist = DB::table('persons')->where('id',$request->get('id'))->first();
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imagefile = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/persons/', $imagefile);
            $image = '/persons/'.$imagefile;
            if($exist->image){
                $oldImage = public_path($exist->image);
                if (file_exists($oldImage)){
                    unlink($oldImage);
                }
            }
        }
        $result = DB::table('persons')->where('id',$request->get('id'))->update([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'sub_category_id' => $request->get('sub_category_id'),
            'sub_sub_category_id' => $request->get('sub_sub_category_id'),
            'designation_id' => $request->get('designation_id'),
            'contact' => $request->get('contact'),
            'email' => $request->get('email'),
            'image' => $image,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function destroy($id){
        $result = DB::table('persons')->where('id',$id)->update([
            'deleted_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function active($id){
        $result = DB::table('persons')->where('id',$id)->update([
            'active' => 1,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function deactive($id){
        $result = DB::table('persons')->where('id',$id)->update([
            'active' => 0,
            'updated_at' => now()
        ]);
        if($result){
            return 1;
        }
        return 0;
    }
}
