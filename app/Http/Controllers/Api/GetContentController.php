<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Models\Admin\ContactModel;
use App\Models\Admin\ContentModel; 
use App\Models\Admin\settings\CategoryModel; 
use DB;
use Validator;

// 200: OK. The standard success code and default option.
// 201: Object created. Useful for the store actions.
// 204: No content. When an action was executed successfully, but there is no content to return.
// 206: Partial content. Useful when you have to return a paginated list of resources.
// 400: Bad request. The standard option for requests that fail to pass validation.
// 401: Unauthorized. The user needs to be authenticated.
// 403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
// 404: Not found. This will be returned automatically by Laravel when the resource is not found.
// 500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
// 503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.

class GetContentController extends Controller {


    public function get_data($limit,$offset){
        
        $limit = intval ($limit);
        $offset = intval ($offset);
        $resultArray = array();
        $contentByCat = array();
        $singleContent = array();
        // $options = app('request')->header('accept-charset') == 'utf-8' ? JSON_UNESCAPED_UNICODE : null;

        if(is_int($limit) && is_int($offset)){

              //dd($offset);
            $getAllCategory = CategoryModel::where('status','=',1)->orderBy('priority_order','desc')->get();
            if($getAllCategory && $getAllCategory->count()){

                foreach($getAllCategory as $val){

                    $content=ContentModel::where('cat_id','=',$val->id)
                    ->skip($offset)->take($limit)
                   ->orderBy('id', 'desc')

                    ->get([
                        'cat_id as catId',
                        'id as ID',
                        'jpg_name as jpgImage',
                        'png_name as pngImage',
                        'is_new as isNew']
                    )
                    ->toArray();

                    // modify and rearrange content

                    if($content && count($content)){

                        foreach($content as $ind=>$va){
                            $content[$ind] = array(
                                    'ID' => $va['ID'],
                                    'jpgImage' => url('public/uploads_images/'.$va['catId'].'/jpg/'.$va['jpgImage']),
                                    'pngImage' => url('public/uploads_images/'.$va['catId'].'/png/'.$va['pngImage']),
                                    'isNew' => $va['isNew']    
                            );
                        }
                    }

                     $singleContent = array(
                            'name'=> $val->name,
                            'cat_id' => $val->id,
                            'content' => $content
                        );
                    
                    $resultArray[]=($singleContent);
                }
                //dd($resultArray);
                return response()->json($resultArray, 200,[],JSON_UNESCAPED_SLASHES);
            }else{
                return response()->json('category_not_found', 204,[],JSON_UNESCAPED_SLASHES)->header('Content-Type', "application/json");

            }

        }else{
           return response()->json('bad_request', 400,[],JSON_UNESCAPED_SLASHES);
        }

           return response()->json('bad_request', 400,[],JSON_UNESCAPED_SLASHES);
        
    }

    public function getdata_by_category($id,$limit,$offset){
        
        $limit = intval ($limit);
        $offset = intval ($offset);
        $resultArray = array();
        $contentByCat = array();
        $singleContent = array();
        // $options = app('request')->header('accept-charset') == 'utf-8' ? JSON_UNESCAPED_UNICODE : null;

        if(is_int($limit) && is_int($offset)){

              //dd($offset);
            $getAllCategory = CategoryModel::where('id','=',$id)->where('status','=',1)->get();
            if($getAllCategory && $getAllCategory->count()){

                foreach($getAllCategory as $val){

                    $content=ContentModel::where('cat_id','=',$val->id)
                    ->skip($offset)->take($limit)
                    ->orderBy('id', 'desc')

                    ->get([
                        'cat_id as catId',
                        'id as ID',
                        'jpg_name as jpgImage',
                        'png_name as pngImage',
                        'is_new as isNew']
                    )
                    ->toArray();

                    // modify and rearrange content

                    if($content && count($content)){

                        foreach($content as $ind=>$va){
                            $content[$ind] = array(
                                    'ID' => $va['ID'],
                                    'jpgImage' => url('public/uploads_images/'.$va['catId'].'/jpg/'.$va['jpgImage']),
                                    'pngImage' => url('public/uploads_images/'.$va['catId'].'/png/'.$va['pngImage']),
                                    'isNew' => $va['isNew']    
                            );
                        }
                    }

                     $singleContent = array(
                            'name'=> $val->name,
                            'cat_id' => $val->id,
                            'content' => $content
                        );
                    
                    $resultArray[]=($singleContent);
                }
                //dd($resultArray);
                return response()->json($resultArray, 200,[],JSON_UNESCAPED_SLASHES);
            }else{
                return response()->json('category_not_found', 204,[],JSON_UNESCAPED_SLASHES)->header('Content-Type', "application/json");

            }

        }else{
           return response()->json('bad_request', 400,[],JSON_UNESCAPED_SLASHES);
        }

           return response()->json('bad_request', 400,[],JSON_UNESCAPED_SLASHES);
        
        
    }

    public function create(Request $request) {
        $materialData = CategoryModel::get();
        return view($this->_data['createView'])->with('page', $this->_data)
        ->with('materialData', $materialData);
        
    }

    public function store(Request $request) {

        $userId = \Auth::id();
        $successAlert = $this->_data['pageName'] . ' Successfully Created.';
        $errorAlert = 'Could Not Create ' . $this->_data['pageName'] . ' Some Error Occured in The Page.';
        $currentTimestamp = date('Y-m-d H:i:s');

        $validator = Validator::make(
                        $request->all(), 
                        $this->validation['rules'],
                        $this->validation['messages']
        );
        if ( $validator->fails() ) {
            //dd($validator->errors());
            return redirect()->back()->with("alert", ['type' => 'danger', 'msg' => $errorAlert ])
                            ->with("errors", $validator->errors())->withInput()
                            ->with('page', $this->_data);
        } else {


            if($request->hasFile('jpg_name')){

                $getimageNameJpg = $request->cat_id.'_jpg_'.time().'.'.$request->jpg_name->getClientOriginalExtension();
                   
                $request->jpg_name->move(public_path('uploads_images/'.$request->cat_id.'/jpg'), $getimageNameJpg);    
                
            }
            if($request->hasFile('png_name')){

                $getimageNamePng = $request->cat_id.'_png_'.time().'.'.$request->png_name->getClientOriginalExtension();
                   
                $request->png_name->move(public_path('uploads_images/'.$request->cat_id.'/png'), $getimageNamePng);    
                
            }
           
           
            $data['cat_id'] = $request->cat_id;
            $data['png_name'] = $getimageNamePng;
            $data['jpg_name'] = $getimageNameJpg;
            $data['is_new'] = $request->status;
            $data['created_at'] = $currentTimestamp;


            $insert = ContentModel::insert($data);

            if ( $insert ) {

                return redirect(route($this->_data['listAll']))
                                ->with("alert", ['type' => 'success', 'msg' => $successAlert ]);
            } else {

                return redirect()->back()
                                ->with("alert", ['type' => 'danger', 'msg' => $errorAlert ])->withInput()
                                ->with('page', $this->_data);
            }
        }
    }

    public function edit($id) {
        $resourceData = ContentModel::find($id);
        $materialData = CategoryModel::get();
        // dd($resourceData);
        if ( $resourceData ) {

            return view($this->_data['editView'], ['resourceData' => $resourceData ])
                            ->with('page', $this->_data)
                            ->with('materialData', $materialData);
        } else {
            return redirect(route($this->_data['listAll']));
        }
    }

    public function update(Request $request, $id) {

        $resourceData = ContentModel::find($id);
        $successAlert = $this->_data['pageNameEdit'] . ' Successfully Updated.';
        $errorAlert = 'Could Not Create ' . $this->_data['pageName'] . ' Some Error Occured in The Page.';
        $currentTimestamp = date('Y-m-d H:i:s');



        $validator = Validator::make(
                        $request->all(), 
                        $this->validation['rules'],
                        $this->validation['messages']
        );


        if ( $validator->fails() ):
            return redirect()->back()->with('alert', ['type' => 'danger', 'msg' => $errorAlert ])
                            ->with('errors', $validator->errors())
                            ->withInput()
                            ->with('page', $this->_data);
        else:


            if($request->hasFile('jpg_name')){

                $getimageNameJpg = $request->cat_id.'_jpg_'.time().'.'.$request->jpg_name->getClientOriginalExtension();
                   
                $request->jpg_name->move(public_path('uploads_images/'.$request->cat_id.'/jpg'), $getimageNameJpg);    
                $resourceData->jpg_name = $getimageNameJpg;
                if(file_exists(public_path(public_path('uploads_images/'.$request->cat_id.'/jpg/'.$request->jpg_name_h)))){
                    @unlink(public_path('uploads_images/'.$request->cat_id.'/jpg/'.$request->jpg_name_h));
                }

            }
            if($request->hasFile('png_name')){

                $getimageNamePng = $request->cat_id.'_png_'.time().'.'.$request->png_name->getClientOriginalExtension();
                   
                $request->png_name->move(public_path('uploads_images/'.$request->cat_id.'/png'), $getimageNamePng);    
                $resourceData->png_name = $getimageNamePng;
                if(file_exists(public_path(public_path('uploads_images/'.$request->cat_id.'/png/'.$request->png_name_h)))){
                    @unlink(public_path('uploads_images/'.$request->cat_id.'/png/'.$request->png_name_h));
                }

            }
           
           
            $resourceData->cat_id = $request->cat_id;
            
            $resourceData->is_new = $request->status;
            $resourceData->updated_at = $currentTimestamp;
            

            if ( $resourceData->save() ):
                return redirect(route($this->_data['listAll']))->with('alert', ['type' => 'success', 'msg' => $successAlert ]);
            else:
                return redirect()->back()
                                ->with('alert', ['type' => 'danger', 'msg' => $errorAlert ])
                                ->with('resourceData', $resourceData)
                                ->with('page', $this->_data);
            endif;
        endif;
    }
    public function delete($id) {

        $resourceData = ContentModel::find($id);

        if ( $resourceData ):

            //$pageTitle = $resourceData->name;
            if ( $resourceData->delete() ):
                return redirect(route($this->_data['listAll']))
                                ->with("alert", ['type' => 'success', 'msg' => $this->_data['pageName']. " deleted successfull " ])
                                ->with('page', $this->_data);

            else:
                return redirect()->back()->with("alert", ['type' => 'danger', 'msg' => $this->_data['pageName'] . '  Could Not be Deleted.' ])->withInput()
                                ->with('page', $this->_data);
            endif;

        else:
            return redirect()->back()
                            ->with("alert", ['type' => 'danger', 'msg' => 'Could not find ' . $this->_data['pageName'] . 'title.' ])
                            ->withInput()
                            ->with('page', $this->_data);
        endif;
    }

}
