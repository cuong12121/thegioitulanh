<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Hash;


use Flash;


class customnUserController extends Controller
{
    public function addUser(Request $request)
    {
        if(Auth::user()->permision ==3){
            $user = new User();
            $email = $request->email;
            $password = bcrypt($request->password);

            $user->password = $password;
            $user->email = $email;
            $user->name  = $request->name;
            $user->permision = 0;
            $user->save();

            return redirect(route('view-user'));
        }
        else{

            echo "bạn không có đủ quyền đăng ký cho user";
            return redirect()->back();
        }

       
    }

    public function registerUser()
    {
        if(Auth::user()->permision ==3){
            return view('register');
        }
        else{
            return redirect(route('homeFe'));
        }
        
    }

    public function viewUser()
    {
        if(Auth::user()->permision ==3){
           
            return view('user.index');
        }
        else{
            return redirect(route('homeFe'));
        }
    }

    public function updatePermision(Request $request)
    {
        if(Auth::user()->permision ==3){

            $id= $request->id;

            $permision = $request->permision;

            $user = User::find($id);

            if($user->permision <3){

                $user->permision = $permision;

                $user->save();

                Session::flash('success', 'Cấp quyền thành công!');

            }
            else{
                Session::flash('error', 'Bạn không thể hạ quyền admin của người này');

            }

            
        }  
        else{
            Session::flash('error', 'Bạn không đủ thẩm quyền để cấp quyền!');

        }  
        return redirect(route('view-user'));
    }

    public function deleteUser(Request $request)
    {
       
       if(Auth::user()->permision ==3){

            $id= $request->id;

            $user = User::find($id);

            if($user->permision<3){

                $user->delete();

                Session::flash('success', 'xóa user thành công');

            } 
            else{

                Session::flash('error', 'Bạn không thể xóa  người này do họ có quyền admin');

            }  

       }
        return redirect(route('view-user'));
    }

    public function changePassWord(Request $request)
    {
        $id = Auth::user()->id;

        $password = $request->password;

        $old_password = $request->old_password;

    


        $user_info = User::find($id);
        $hashedPassword = $user_info->password;
 
        if (Hash::check($old_password, trim($hashedPassword))) {

             $user_info->password = bcrypt($password);

             $user_info->save();

             Session::flash('success', 'Đổi mật khẩu thành công');

       
        }
        else{
            Session::flash('error', 'Mật khẩu cũ không đúng');

           
        }
         return redirect()->back();
    }

   
}
