<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DirectoryController extends Controller
{
	public function index(){
		$data['persons'] = DB::table('persons')
			->leftJoin('categories','categories.id','=','persons.category_id')
            ->leftJoin('sub_categories','sub_categories.id','=','persons.sub_category_id')
            ->leftJoin('sub_sub_categories','sub_sub_categories.id','=','persons.sub_sub_category_id')
            ->leftJoin('designations','designations.id','=','persons.designation_id')
            ->where('persons.deleted_at',null)
			->where('persons.active',1)
			->where('persons.category_id',null)
			->select('persons.*','categories.name as category_name','sub_categories.name as sub_category_name','sub_sub_categories.name as sub_sub_category_name','designations.name as designation_name')
			->get();
		for($i=0;$i<count($data['persons']);$i++){
			if($data['persons'][$i]->image){
				$data['persons'][$i]->image = 'http://bsmrau.orangebd.com'.$data['persons'][$i]->image;
			}else{
				$data['persons'][$i]->image = 'http://bsmrau.orangebd.com'.'/persons/user.png';
			}
		}
		$data['layers'] = DB::table('categories')->where('deleted_at',null)->where('active',1)->get();
		
		return json_encode($data);
	}

	public function subLayers($id){
		$data['persons'] = DB::table('persons')
			->leftJoin('categories','categories.id','=','persons.category_id')
            ->leftJoin('sub_categories','sub_categories.id','=','persons.sub_category_id')
            ->leftJoin('sub_sub_categories','sub_sub_categories.id','=','persons.sub_sub_category_id')
            ->leftJoin('designations','designations.id','=','persons.designation_id')
            ->where('persons.deleted_at',null)
			->where('persons.active',1)
			->where('persons.category_id',$id)
			->where('persons.sub_category_id',null)
			->select('persons.*','categories.name as category_name','sub_categories.name as sub_category_name','sub_sub_categories.name as sub_sub_category_name','designations.name as designation_name')
			->get();
		for($i=0;$i<count($data['persons']);$i++){
			if($data['persons'][$i]->image){
				$data['persons'][$i]->image = 'http://bsmrau.orangebd.com'.$data['persons'][$i]->image;
			}else{
				$data['persons'][$i]->image = 'http://bsmrau.orangebd.com'.'/persons/user.png';
			}
		}
		$data['sub_layers'] = DB::table('sub_categories')->where('deleted_at',null)->where('active',1)->where('category_id',$id)->get();

		return json_encode($data);
	}

	public function subSubLayers($id){
		$data['persons'] = DB::table('persons')
			->leftJoin('categories','categories.id','=','persons.category_id')
            ->leftJoin('sub_categories','sub_categories.id','=','persons.sub_category_id')
            ->leftJoin('sub_sub_categories','sub_sub_categories.id','=','persons.sub_sub_category_id')
            ->leftJoin('designations','designations.id','=','persons.designation_id')
            ->where('persons.deleted_at',null)
			->where('persons.active',1)
			->where('persons.sub_category_id',$id)
			->where('persons.sub_sub_category_id',null)
			->select('persons.*','categories.name as category_name','sub_categories.name as sub_category_name','sub_sub_categories.name as sub_sub_category_name','designations.name as designation_name')
			->get();
		for($i=0;$i<count($data['persons']);$i++){
			if($data['persons'][$i]->image){
				$data['persons'][$i]->image = 'http://bsmrau.orangebd.com'.$data['persons'][$i]->image;
			}else{
				$data['persons'][$i]->image = 'http://bsmrau.orangebd.com'.'/persons/user.png';
			}
		}
		$data['sub_sub_layers'] = DB::table('sub_sub_categories')->where('deleted_at',null)->where('active',1)->where('sub_category_id',$id)->get();

		return json_encode($data);
	}

	public function subSubSubLayers($id){
		$data['persons'] = DB::table('persons')
			->leftJoin('categories','categories.id','=','persons.category_id')
            ->leftJoin('sub_categories','sub_categories.id','=','persons.sub_category_id')
            ->leftJoin('sub_sub_categories','sub_sub_categories.id','=','persons.sub_sub_category_id')
            ->leftJoin('designations','designations.id','=','persons.designation_id')
            ->where('persons.deleted_at',null)
			->where('persons.active',1)
			->where('persons.sub_sub_category_id',$id)
			// ->where('persons.sub_sub_category_id',null)
			->select('persons.*','categories.name as category_name','sub_categories.name as sub_category_name','sub_sub_categories.name as sub_sub_category_name','designations.name as designation_name')
			->get();
		for($i=0;$i<count($data['persons']);$i++){
			if($data['persons'][$i]->image){
				$data['persons'][$i]->image = 'http://bsmrau.orangebd.com'.$data['persons'][$i]->image;
			}else{
				$data['persons'][$i]->image = 'http://bsmrau.orangebd.com'.'/persons/user.png';
			}
		}

		return json_encode($data);
	}
}