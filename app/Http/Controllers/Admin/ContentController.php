<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Models\Admin\ContactModel;
use App\Models\Admin\ContentModel; 
use App\Models\Admin\settings\CategoryModel; 

use Validator;
use DB;
class ContentController extends Controller {

    public $_data = [
        'ParentActive' => 'parent_settings',
        'active' => 'content',
        'pageName' => 'content',
        'pageNameEdit' => 'Edit content',
        'editButton' => 'admin.content.edit',
        'createButton' => 'admin.content.create',
        'deleteButton' => 'admin.content.delete',
        'storeAction' => 'admin.content.store',
        'updateAction' => 'admin.content.update',
        'listAll' => 'admin.content.index',
        'cancelAction' => 'admin.content.index',
        'modelName' => 'content',
        'indexView' => 'Admin.blocks.content.index',
        'createView' => 'Admin.blocks.content.create',
        'editView' => 'Admin.blocks.content.edit',
    ];
    protected $validation = [
        'rules' => [
            'jpg_name' => [
                'nullable',
            ],
            'cat_id' =>[
                'required',
            ],
            'png_name' => [
                'nullable',
            ],
        ],
        'messages' => [
            'cat_id.required' => 'Please select a catgory ',
        ],
    ];


    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
//        return view($this->_data['indexView'])->with('page', $this->_data)->with('data',$data)->with('oderer',$oderer)->with('new_data',$new_data)->with('driver',$driver);
        $resourceData =  ContentModel::get();
        return view($this->_data['indexView'])->with('page', $this->_data)->with('data', $resourceData);
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
            $data['is_new'] = $request->status ? $request->status : 0;
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
                if(file_exists(public_path(('uploads_images/'.$request->cat_id.'/jpg/'.$request->jpg_name_h)))){
                    @unlink(public_path('uploads_images/'.$request->cat_id.'/jpg/'.$request->jpg_name_h));
                }

            }
            if($request->hasFile('png_name')){

                $getimageNamePng = $request->cat_id.'_png_'.time().'.'.$request->png_name->getClientOriginalExtension();
                   
                $request->png_name->move(public_path('uploads_images/'.$request->cat_id.'/png'), $getimageNamePng);    
                $resourceData->png_name = $getimageNamePng;
                if(file_exists(public_path(('uploads_images/'.$request->cat_id.'/png/'.$request->png_name_h)))){
                    @unlink(public_path('uploads_images/'.$request->cat_id.'/png/'.$request->png_name_h));
                }

            }
           
           
            $resourceData->cat_id = $request->cat_id;
            
            $resourceData->is_new = $request->status ? $request->status : 0;
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
            // echo 'uploads_images/'.$resourceData->cat_id.'/jpg/'.$resourceData->jpg_name;
            
            if(file_exists(public_path('uploads_images/'.$resourceData->cat_id.'/jpg/'.$resourceData->jpg_name))){
                    @unlink(public_path('uploads_images/'.$resourceData->cat_id.'/jpg/'.$resourceData->jpg_name));
            }
            
            if(file_exists((public_path('uploads_images/'.$resourceData->cat_id.'/png/'.$resourceData->png_name)))){
                    @unlink(public_path('uploads_images/'.$resourceData->cat_id.'/png/'.$resourceData->png_name));
                    
            }
            
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
