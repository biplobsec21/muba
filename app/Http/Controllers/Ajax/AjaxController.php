<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use DB;
use App\Models\Admin\settings\LocationModel;


class AjaxController extends Controller {


    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {

    }
    
    public function location_by_keyword(Request $request){
       $keyword=$request->get('keyword');
       $locations = LocationModel::select('id','name')
                                 ->where('name','like','%'.$keyword.'%')
                                 ->where('status',1)
                                 ->get();


       $return = [
          'msg' => 'success',
          'items' => $locations
        ];
        return json_encode($return);


    }

    public function doctor_by_keyword(Request $request){
        $keyword=$request->get('keyword');
        // $process_type_id=$request->get('process_type_id');
        // $location_id=$request->get('location_id');

        // if($process_type_id && $location_id){

        //   $sql="SELECT doctors.id,doctors.name FROM doctor_process_types
        //         JOIN doctors ON doctor_process_types.`doctor_id` = doctors.`id`
        //         WHERE process_type_id = ".$process_type_id."
        //         AND doctors.`status` = 1
        //         AND doctor_process_types.`status`  =1
        //         AND doctors.id IN (SELECT doctors.id FROM locations
        //         JOIN doctor_work_regions ON doctor_work_regions.`work_region_id` = locations.`work_region_id`
        //         JOIN doctors ON doctor_work_regions.`doctor_id` = doctors.`id`
        //         WHERE locations.id = ".$location_id." AND doctor_work_regions.`status`=1)
        //         AND doctors.name like '%".$keyword."%'
        //         ORDER BY doctors.id ASC";
        //   $doctors = DB::select(DB::raw($sql));

        // }else{
        //   $doctors = null;
        // }

        $sql="SELECT doctors.id,doctors.name FROM doctors
                WHERE doctors.`status` = 1
                AND doctors.name like '%".$keyword."%'
                ORDER BY doctors.id ASC";
        $doctors = DB::select(DB::raw($sql));

        $return = [
          'msg' => 'success',
          'items' => $doctors
        ];
        return json_encode($return);
    }

    public function representative_by_keyword(Request $request){
        $keyword=$request->get('keyword');
        // $location_id=$request->get('location_id');
        // if($location_id){
        //   $sql="SELECT representatives.id,representatives.name FROM locations
        //         JOIN representative_work_regions ON representative_work_regions.`work_region_id` = locations.`work_region_id`
        //         JOIN representatives ON representative_work_regions.`representative_id` = representatives.`id`
        //         WHERE locations.id = ".$location_id."
        //         AND representatives.`status` = 1
        //         AND representative_work_regions.`status`=1
        //         AND representatives.name like '%".$keyword."%'
        //         ORDER BY representatives.id ASC";
        //   $representatives = DB::select(DB::raw($sql));
        // }else{
        //   $representatives = null;
        // }

        $sql="SELECT representatives.id,representatives.name FROM representatives
                WHERE representatives.`status` = 1
                AND representatives.name like '%".$keyword."%'
                ORDER BY representatives.id ASC";
        $representatives = DB::select(DB::raw($sql));

        $return = [
          'msg' => 'success',
          'items' => $representatives
        ];
        return json_encode($return);
    }

}
