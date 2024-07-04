<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Models\Admin\ContactModel;
use Validator;

class ProfileController extends Controller {

    public $_data = [
        'active' => 'profile',
        'pageName' => 'My Profile',
        'editButton' => 'admin.profile.edit',
        'updateAction' => 'admin.profile.update',
        'cancelAction' => 'admin.profile.index',
        'modelName' => 'ProfileModel',
        'indexView' => 'Admin.blocks.profile.index',
        'editView' => 'Admin.blocks.profile.edit',
    ];

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
//        return view($this->_data['indexView'])->with('page', $this->_data)->with('data',$data)->with('oderer',$oderer)->with('new_data',$new_data)->with('driver',$driver);

        return view($this->_data['indexView'])->with('page', $this->_data);
    }

    public function create(Request $request) {
        return view($this->_data['createView'])->with('page', $this->_data);
    }

}
