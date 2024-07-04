<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin\UserModel;
use Validator;

class AdminUserController extends Controller {

    public $_data = [
        'listAll' => 'admin.adminuser.index',
        'active' => 'adminuser',
        'pageName' => 'Admin User',
        'editButton' => 'admin.adminuser.edit',
        'createButton' => 'admin.adminuser.create',
        'deleteButton' => 'admin.adminuser.delete',
        'storeAction' => 'admin.adminuser.store',
        'updateAction' => 'admin.adminuser.update',
        'listAll' => 'admin.adminuser.index',
        'cancelAction' => 'admin.adminuser.index',
        'modelName' => 'AdminUser',
        'indexView' => 'Admin.blocks.adminuser.index',
        'createView' => 'Admin.blocks.adminuser.create',
        'editView' => 'Admin.blocks.adminuser.edit',
    ];

    public function __construct() {
//        $this->middleware('auth');
    }

    public function index(Request $request) {

//        $allResource=getAllResource();
//        
//        dd($allResource);


        $searchData = UserModel::where('status', '=', 1)->get();
        return view($this->_data['indexView'])->with('page', $this->_data)->with('data', $searchData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view($this->_data['createView'])
                        ->with('page', $this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        //dd($request->all());
        //dd(bcrypt($request->password));
        $successAlert = $this->_data['pageName'] . ' Successfully Created.';
        $errorAlert = 'Could Not Create ' . $this->_data['pageName'] . ' Some Error Occured in The Page.';
        $currentTimestamp = date('Y-m-d H:i:s');
        $validator = Validator::make(
                        $request->all(), [
                    'name' => 'required',
                    'user_name' => 'required|unique:users,username',
                    'email' => 'required|unique:users,email',
                    'password' => 'required',
                    'user_type' => 'required',
                        ], [
                    'user_type.required' => $this->_data['pageName'] . ' User type Field is Required',
                    'password.required' => $this->_data['pageName'] . ' Password Field is Required',
                    'name.required' => $this->_data['pageName'] . ' Name Field is Required',
                    'email.unique' => $this->_data['pageName'] . $request->email . '" Already Exists.',
                    'user_name.unique' => $this->_data['pageName'] . $request->user_name . '" user name Already Exists.',
                        ]
        );

        if ( $validator->fails() ) {
            return redirect()->back()->with("alert", ['type' => 'danger', 'msg' => $errorAlert ])
                            ->with("errors", $validator->errors())->withInput()
                            ->with('page', $this->_data);
        } else {

            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['username'] = $request->user_name;
            $data['password'] = bcrypt($request->password);
            $data['password2'] = $request->password2;
            $data['user_type'] = $request->user_type;
            $data['created_at'] = $currentTimestamp;
            
            //$data['user_id']    = 1; // here the user id is static 

            $insert = UserModel::insert($data);

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $resourceData = UserModel::find($id);
       // dd($resourceData);
        if ( $resourceData ) {

            return view($this->_data['editView'], ['resourceData' => $resourceData ])
                            ->with('page', $this->_data);
        } else {
            return redirect(route($this->_data['listAll']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $resourceData = UserModel::find($id);
        $successAlert = $this->_data['pageName'] . ' Successfully Updated.';
        $errorAlert = 'Could Not Create ' . $this->_data['pageName'] . ' Some Error Occured in The Page.';
        $currentTimestamp = date('Y-m-d H:i:s');
        $validator = Validator::make(
                        $request->all(), [
                    'name' => 'required',
                    'user_name' => 'required|unique:users,username,'.$id,
                    'email' => 'required|unique:users,email,'.$id,
                    'password' => 'required',
                    'user_type' => 'required',
                        ], [
                    'user_type.required' => $this->_data['pageName'] . ' User type Field is Required',
                    'password.required' => $this->_data['pageName'] . ' Password Field is Required',
                    'name.required' => $this->_data['pageName'] . ' Name Field is Required',
                    'email.unique' => $this->_data['pageName'] . $request->email . '" Already Exists.',
                    'user_name.unique' => $this->_data['pageName'] . $request->user_name . '" user name Already Exists.',
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
            
            $resourceData->name = $request->name;
            $resourceData->email = $request->email;
            $resourceData->username = $request->user_name;
            $resourceData->user_type = $request->user_type;
            $resourceData->password = bcrypt($request->password);
            $resourceData->password2 = $request->password2;
            $resourceData->updated_at = $currentTimestamp;
            $resourceData->status = 1;
            
            if ( $resourceData->save() ):
                return redirect(route($this->_data['listAll']))->with('alert', ['type' => 'success', 'msg' => $successAlert ]);
            else:
                return redirect()->back()
                                ->with('alert', ['type' => 'danger', 'msg' => $errorAlert ])
                                ->with('resourceData',$resourceData)
                                ->with('page', $this->_data);
            endif;
        endif;

 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function delete($id) {

        $resourceData = UserModel::find($id);

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

    public function reset_search(Request $request) {

        $request->session()->forget('pre_search_data');
        return redirect(route($this->_data['listAll']))->with('page', $this->_data);
    }

}
