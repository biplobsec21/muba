<?php
/* ----------------------- Convert Y-m-d data to m-d-Y from db ------------------------- */
if( !function_exists( 'changeFormat' ) ) {
    function changeFormat($date, $from_format, $to_format) {
        return date_format( date_create_from_format($from_format, $date), $to_format);
    }
}
if( !function_exists( 'siteDateFormat' ) ) {
    function siteDateFormat($data) {
        return date_format( date_create_from_format('Y-m-d', $data),'m-d-Y');
    }
}
if( !function_exists( 'dbDateFormat' ) ) {
    function dbDateFormat($data) {
        return date_format( date_create_from_format('m-d-Y', $data),'Y-m-d');
    }
}
if( !function_exists( 'checkProfAvailability' ) ) {
    function checkProfAvailability($prof_id, $date, $start_time, $end_time) {
    	$sql="SELECT COUNT(*) as avail FROM professional_busy_calendar
				WHERE date='".$date."'
				AND professional_id = ".$prof_id."
				AND ('".$start_time."' BETWEEN start_time AND end_time
				OR '".$end_time."' BETWEEN start_time AND end_time)";
    	$data = DB::select(DB::raw($sql));
    	if($data[0]->avail > 0){
    		return false;
    	}else{
    		return true;
    	}

    }
}
if( !function_exists( 'dayofTheWeek' ) ) {
    function dayofTheWeek($data) {
        
    }
}
if (!function_exists('common_query_for_table_data')) {
	function common_query_for_table_data($select,$table,$where) {
	    $sql="select $select from $table where $where";
	  return DB::select( DB::raw($sql));
	 }
}
if (!function_exists('professinal_work_region_by_id')) {
	function professinal_work_region_by_id($id) {
	    $sql="select work_regions.name from work_regions,professional_work_regions,professionals"
                    . " where professional_work_regions.professional_id = professionals.id"
                    . " and professional_work_regions.work_region_id = work_regions.id"
                    . " and professionals.id=".$id;
	  return DB::select( DB::raw($sql));
	 }
}
if (!function_exists('professinal_process_type_by_id')) {
	function professinal_process_type_by_id($id) {
	    $sql="select process_types.name from process_types,professional_process_types,professionals"
                    . " where professional_process_types.professional_id = professionals.id"
                    . " and professional_process_types.process_type_id = process_types.id"
                    . " and professionals.id=".$id;
	  return DB::select( DB::raw($sql));
	 }
}