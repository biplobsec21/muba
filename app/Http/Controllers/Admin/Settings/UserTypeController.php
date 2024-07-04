<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Models\Admin\ContactModel;
use App\Models\Admin\settings\UserTypeModel;
use Validator;

class UserTypeController extends Controller {

    public $_data = [
        'ParentActive' => 'parent_settings',
        'active' => 'usertype',
        'pageName' => 'Add Admin User Type',
        'pageNameEdit' => 'Edit Admin User Type',
        'editButton' => 'admin.settings.usertype.edit',
        'createButton' => 'admin.settings.usertype.create',
        'deleteButton' => 'admin.settings.usertype.delete',
        'storeAction' => 'admin.settings.usertype.store',
        'updateAction' => 'admin.settings.usertype.update',
        'listAll' => 'admin.settings.usertype.index',
        'cancelAction' => 'admin.settings.usertype.index',
        'modelName' => 'UserType',
        'indexView' => 'Admin.blocks.settings.usertype.index',
        'createView' => 'Admin.blocks.settings.usertype.create',
        'editView' => 'Admin.blocks.settings.usertype.edit',
    ];

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
//        return view($this->_data['indexView'])->with('page', $this->_data)->with('data',$data)->with('oderer',$oderer)->with('new_data',$new_data)->with('driver',$driver);
        $resourceData = UserTypeModel::get();
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
                        $request->all(), [
                    'name' => 'required',
                        ], [
                    'name.required' => $this->_data['pageName'] . ' Name Field is Required',
                        ]
        );

        if ( $validator->fails() ) {
            return redirect()->back()->with("alert", ['type' => 'danger', 'msg' => $errorAlert ])
                            ->with("errors", $validator->errors())->withInput()
                            ->with('page', $this->_data);
        } else {

            $data['name'] = $request->name;
            $data['status'] = $request->status;
            $data['created_by'] = $userId;
            $data['created_at'] = $currentTimestamp;

            //$data['user_id']    = 1; // here the user id is static 

            $insert = UserTypeModel::insert($data);

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
        $resourceData = UserTypeModel::find($id);
        // dd($resourceData);
        if ( $resourceData ) {

            return view($this->_data['editView'], ['resourceData' => $resourceData ])
                            ->with('page', $this->_data);
        } else {
            return redirect(route($this->_data['listAll']));
        }
    }

    public function update(Request $request, $id) {

        $resourceData = UserTypeModel::find($id);
        $successAlert = $this->_data['pageNameEdit'] . ' Successfully Updated.';
        $errorAlert = 'Could Not Create ' . $this->_data['pageName'] . ' Some Error Occured in The Page.';
        $currentTimestamp = date('Y-m-d H:i:s');
        $validator = Validator::make(
                        $request->all(), [
                    'name' => 'required',
                        ], [
                    'name.required' => $this->_data['pageName'] . ' Name Field is Required',
                        ]
        );



        if ( $validator->fails() ):
            return redirect()->back()->with('alert', ['type' => 'danger', 'msg' => $errorAlert ])
                            ->with('errors', $validator->errors())
                            ->withInput()
                            ->with('page', $this->_data);
        else:
            $resourceData->name = $request->name;
            $resourceData->status = $request->status;

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

        $resourceData = UserTypeModel::find($id);

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
