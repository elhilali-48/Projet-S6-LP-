<?php

namespace App\Http\Controllers;

use App\Http\Requests\mdp_request;
use App\Http\Requests\User_Request;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User_Controller extends Controller
{
    public function index(User $user){
        $user = User::all();
      return view('users.index',["user"=>$user]);
       
    }
    public function edit(User $user ){
        
        //  $user=  $user->profile;
        return view('users.profile',['user'=>$user] );
    }
    public function update(User_Request $request , User $user){
      
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->about = $request->about;
        if($request->hasFile('image')){
                $image = $request->image->store('Image_Users','public');
                $user->image=$image;
             }
        $user->save();
        return redirect('/home');
    }

    public function mdp( $id){
        
        $user = User::findOrfail($id);
        return view('users.change',['user'=>$user] );
    }

    public function change_mdp(mdp_request $request ,$id){
        

        $password_old = Auth::user()->password;

        if(Hash::check($request->mdp_an, $password_old)){
            if(!Hash::check($request->mdp_nv, $password_old)){
                $user= User::findOrfail($id);
                $user->password = bcrypt($request->mdp_nv);
                User::where('id', Auth::user()->id)->update(array('password'=>$user->password));
                session()->flash('success','Mot de passe bien modifier');
                return redirect()->back();
            }
            else{
                session()->flash('error',"Le nouveau mot de passe ne peut pas être l'ancien !");
                return redirect()->back();
            }

        }
        else{
            session()->flash('error',"l'ancien mot de passe ne correspond pas");
            return redirect()->back();
        }
    }
    public function make_admin(User $user){
        if($user->isAdmin()){
            $user->role = 'user';
            $user->save();
            session()->flash('succes',"$user->name est changer en utilisateur");
            return \redirect(route('users.index'));
        }
        else{
            $user->role = 'admin';
            $user->save();
            session()->flash('success',"$user->name est Admin Maintenant");
            return \redirect(route('users.index'));
        }
       
    }
    public function delete(User $user){
        $user->delete();
        return redirect(route('users.index'));
    }
 
}
