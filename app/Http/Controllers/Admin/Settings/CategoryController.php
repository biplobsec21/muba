<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Models\Admin\ContactModel;
use App\Models\Admin\settings\CategoryModel; 
use Validator;

class CategoryController extends Controller {

    public $_data = [
        'ParentActive' => 'parent_settings',
        'active' => 'category',
        'pageName' => 'Category',
        'pageNameEdit' => 'Edit Category',
        'editButton' => 'admin.settings.category.edit',
        'createButton' => 'admin.settings.category.create',
        'deleteButton' => 'admin.settings.category.delete',
        'storeAction' => 'admin.settings.category.store',
        'updateAction' => 'admin.settings.category.update',
        'listAll' => 'admin.settings.category.index',
        'cancelAction' => 'admin.settings.category.index',
        'modelName' => 'category',
        'indexView' => 'Admin.blocks.settings.category.index',
        'createView' => 'Admin.blocks.settings.category.create',
        'editView' => 'Admin.blocks.settings.category.edit',
    ];
    protected $validation = [
        'rules' => [
            'name' => [
                'required',
            ],
            'icon_name' => [
                'nullable',
            ],
        ],
        'messages' => [
            'name.required' => ' Name Field is Required',
        ],
    ];

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
//        return view($this->_data['indexView'])->with('page', $this->_data)->with('data',$data)->with('oderer',$oderer)->with('new_data',$new_data)->with('driver',$driver);
        $resourceData =  CategoryModel::get();
        return view($this->_data['indexView'])->with('page', $this->_data)->with('data', $resourceData);
    }

    public function create(Request $request) {
        return view($this->_data['createView'])->with('page', $this->_data);
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


            if($request->hasFile('icon_name')){

                $getimageName = 'category_images'.time().'.'.$request->icon_name->getClientOriginalExtension();
                   
                $request->icon_name->move(public_path('uploads_images'), $getimageName);    

            }else{

                $getimageName=''; 

            }
           
            $data['name'] = $request->name;
            $data['status'] = $request->status;
           // $data['created_by'] = $userId;
            $data['icon'] = $getimageName;
            $data['created_at'] = $currentTimestamp;
            $data['priority_order'] =isset($request->priority_order) ? $request->priority_order : NULL;
            
            //$data['user_id']    = 1; // here the user id is static 

            $insert = CategoryModel::insert($data);

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
        $resourceData = CategoryModel::find($id);
        // dd($resourceData);
        if ( $resourceData ) {

            return view($this->_data['editView'], ['resourceData' => $resourceData ])
                            ->with('page', $this->_data);
        } else {
            return redirect(route($this->_data['listAll']));
        }
    }

    public function update(Request $request, $id) {

        $resourceData = CategoryModel::find($id);
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

            if($request->hasFile('icon_name')){

                $getimageName = 'category_images'.time().'.'.$request->icon_name->getClientOriginalExtension();
                   
                $request->icon_name->move(public_path('uploads_images'), $getimageName);    
                $resourceData->icon = $getimageName;

                if(file_exists(public_path('uploads_images/'.$request->icon_name_hidden))){
                    @unlink(public_path('uploads_images/'.$request->icon_name_hidden));
                }
               // parent::delete();
            }

            $resourceData->name = $request->name;
            $resourceData->status = $request->status;
            $resourceData->updated_at = $currentTimestamp;
            $resourceData->priority_order =isset($request->priority_order) ? $request->priority_order : NULL ;

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

        $resourceData = CategoryModel::find($id);

        if ( $resourceData ):

            $pageTitle = $resourceData->name;
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
