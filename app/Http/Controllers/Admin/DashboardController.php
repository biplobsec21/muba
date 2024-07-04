<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Models\Admin\ContactModel;
use Validator;
use DB;
class DashboardController extends Controller {

    public $_data = [
        'active' => 'dashboard',
        'pageName' => 'Dashboard',
        'indexView' => 'Admin.blocks.dashboard.index',
        'testView' => 'Admin.blocks.dashboard.test'
    ];

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
//        return view($this->_data['indexView'])->with('page', $this->_data)->with('data',$data)->with('oderer',$oderer)->with('new_data',$new_data)->with('driver',$driver);

        return view($this->_data['indexView'])->with('page', $this->_data);
    }

    public function test() {
        $sql = "
            SELECT 

            dayname(sh.schedule_date) as week_of_day, 

            count(if(pr.type = 'Finished',1,null)) as finished,
            count(if(pr.type ='Canceled',1,null)) as canceled

            FROM

            pharmex.schedules as sh 
            left join 
            procedures as pr
            on sh.id = pr.schedule_id
            where sh.procedure_id = pr.id

            group by week_of_day
        ";
        $dayOfTheWeeK = DB::select(DB::raw($sql));
     
        $processArray = array();
        if($dayOfTheWeeK && !empty($dayOfTheWeeK)){
            foreach($dayOfTheWeeK as $ind=>$val){
                    
                    $processArray[$dayOfTheWeeK[$ind]->week_of_day] = array(
                        'finished' => $dayOfTheWeeK[$ind]->finished,
                        'canceled' => $dayOfTheWeeK[$ind]->canceled
                    );
                    
                
            }
        }
        //dd($processArray);
        return view($this->_data['testView'])->with('page', $this->_data)->with('processArray',$processArray);
    }

}
