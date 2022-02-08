<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\GroupModule;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class MainController extends Controller
{
    public function index(){
        return view('main.login',[
            'data' => CompanyProfile::first()
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],[
            'username.required' => 'Username wajib di isi',
            'password.required' => 'Password wajib di isi'
        ]);

        $username = trim($request->input('username'));
        $password = trim($request->input('password'));        

        $data = User::where('username',$username)->first();

        if(!isset($data['username'])){
            return Redirect::back()->withInput()->with('error','Username tidak di temukan');
        }

        if(!Hash::check(trim($request->input('password')),$data['password'])){
            return back()->with('error','Password anda salah')->withInput();   
        }

        $request->session()->put('sesiuserid',$data['id']);
        
        return Redirect::route('home');
    }

    public function logout(){
        if(session()->has('sesiuserid')){
            session()->pull('sesiuserid');
        }
        return redirect()->route('index')->with('error','Logout successfull');
    }

    public function ubahPassword(){
        return view('main.ubahpassword');
    }

    public function changePassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required',
            'repassword' => 'required'
        ],[
            'oldpassword.required' => 'Current password wajib di isi',
            'password.required' => 'New Password wajib di isi',
            'repassword.required' => 'Retype Password wajib di isi'
        ]);

        if(trim($request->input('password')) != trim($request->input('repassword'))){
            return Redirect::back()->with('error','New Password dan Retype Password harus sama')->withInput();
        }

        $data = User::find(session()->get('sesiuserid'));
        if(!isset($data['password'])){
            return Redirect::back()->with('error','Data user tidak di temukan')->withInput();
        }

        if(!Hash::check(trim($request->input('oldpassword')),$data['password'])){
            return Redirect::back()->with('error','Current Password salah')->withInput();   
        }

        try {
            $data->password = Hash::make(trim($request->input('password')));
            $data->update();
            return "<script>parent.$('#modal-action').modal('hide');</script>";
        } catch (\Throwable $th) {
            return Redirect::back()->with('error','Gagal ubah password')->withInput();
        }
    }

    public static function aksesUser(Request $request = NULL){
        $data = array();

        if(!session()->has('sesiuserid')){
            return $data;
        }

        $akses = User::find(session()->get('sesiuserid'))->GroupUser->Module();
        

        $akses = collect($akses->get());
        
        $groupModule = new GroupModule();
        $groupModule = collect($groupModule->whereIn('id',$akses->pluck('group_module_id')->toArray())->orderBy('deskripsi')->get())->toArray();
        foreach($groupModule as $groupModules):
            $module = new Module();
            $module = $request != NULL && $request->has('deskripsi') && trim($request->input('deskripsi')) != '' ? $module->where('deskripsi','like','%'.trim($request->input('deskripsi')).'%') : $module;
            $modules = $module->where('group_module_id',$groupModules['id'])->whereIn('id',$akses->pluck('id')->toArray())->get();
            $module = collect($modules)->toArray();
            foreach($modules as $param):
                $data[$groupModules['deskripsi']][] = [
                    "id" => $param['id'],
                    "deskripsi" => $param['deskripsi'],
                    "route" => $param['route'],
                    "icon" => $param['icon'],
                    "group_module_id" => $param['group_module_id'],
                ];
            endforeach;
            // if(is_array($module) && count($module) > 0){
            //     $data[$groupModules['deskripsi']] = $module;
            // }
        endforeach;
       
        return $data;
    }

    public function home(Request $request){
        return view('main.home',[
            "data" => self::aksesUser($request)
        ]);
    }
}
