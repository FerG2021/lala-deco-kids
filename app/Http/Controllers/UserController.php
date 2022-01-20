<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator, Hash, Auth;

class UserController extends Controller
{
    // agregar un nuevo usuario
    public function getAddUser(){
        return view('pages.user.adduser');
    }

    public function postAddUser(Request $request){
        /*se definen las reglas que debe cumplir el formulario*/
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            //'email' => 'required|email|unique:App\Models\User,email',
            'userName' => 'required|unique:App\Models\User,userName',
            //'password' => 'required|min:8',
            'password' => 'required',
            //'cpassword' => 'required|min:8|same:password'
            'cpassword' => 'required|same:password'
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'lastname.required' => 'El apellido es requerido',
            //'email.required' => 'Su correo electrónico es requerido.',
            //'email.email' => 'El formato de su correo electrónico es inválido',
            //'email.unique' => 'Ya existe un usuario registrado con este correo electrónico',
            'userName.required' => 'El nombre de usuario es requerido',
            'userName.unique' => 'Ya existe un usuario registrado con el nombre de usuario ingresado',
            'password.required' => 'La contraseña es requerida',
            //'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'cpassword.required' => 'Es necesario confirmar la contraseña',
            //'cpassword.min' => 'La contraseña debe tener al menos 8 caracteres',
            'cpassword.same' => 'La contraseñas no coinciden'
        ]; 

        $validator = Validator::make($request->all(), $rules, $messages); /**hacemos uso de validator mediante una variable que recibe como parametros todos los valores requeridos y laa reglas con las cuales debe validar esos datos */

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        else:
            /**si no existe error guardamos la informacion en la bd */
            /**primero recolectamos la informacion que el usario coloca en los campos */
            /**SE GUARDAN LOS USUARIOS EN LA BASE DE DATOS */           
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->userName = e($request->input('userName'));
            $user->password = Hash::make($request->input('password')); //hash permite encriptar la contrasena para que no se guarde como texto plano
                        
            if($user->save()): 
                return back()->with('message', 'El usario se creo con éxito')->with('typealert', 'success');
            endif;
        endif;
    }

    // lista de usuarios
    public function getListUser(){
        $users = User::orderBy('lastname', 'asc')->get();

        return view('pages.user.listusers')->with('users', $users);
    }

    // editar usuario
    public function getEditUser($id){
        $user = User::find($id);

        return view('pages.user.edituser')->with('user', $user)->with('id', $id);
    }

    public function postEditUser(Request $request, $id){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            //'email' => 'required|email|unique:App\Models\User,email',
            'userName' => 'required',
            //'password' => 'required|min:8',
            // 'password' => 'required',
            // //'cpassword' => 'required|min:8|same:password'
            'cpassword' => 'same:password'
        ];

        $messages = [
            'name.required' => 'Su nombre es requerido',
            'lastname.required' => 'Su apellido es requerido',
            //'email.required' => 'Su correo electrónico es requerido.',
            //'email.email' => 'El formato de su correo electrónico es inválido',
            //'email.unique' => 'Ya existe un usuario registrado con este correo electrónico',
            'userName' => 'Su nombre de usuario es requerido',
            'userName.unique' => 'Ya existe un usuario registrado con este nombre de usuario',
            // 'password.required' => 'Por favor, escriba una contraseña',
            //'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            // 'cpassword.required' => 'Es necesario confirmar la contraseña',
            // //'cpassword.min' => 'La contraseña debe tener al menos 8 caracteres',
            'cpassword.same' => 'La contraseñas no coinciden'
        ]; 

        $validator = Validator::make($request->all(), $rules, $messages); /**hacemos uso de validator mediante una variable que recibe como parametros todos los valores requeridos y laa reglas con las cuales debe validar esos datos */

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        else:
            /**si no existe error guardamos la informacion en la bd */
            /**primero recolectamos la informacion que el usario coloca en los campos */
            /**SE GUARDAN LOS USUARIOS EN LA BASE DE DATOS */           
            $user = User::find($id);
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->userName = e($request->input('userName'));

            // verifico si el campo contrasena no esta vacio
            if ($request->input('password') != null) {
                $user->password = Hash::make($request->input('password')); //hash permite encriptar la contrasena para que no se guarde como texto plano
            } else {
                $user->password = $user->password;
            }
           
                        
            if($user->save()): 
                return redirect('/user/listuser')->with('message', 'Usuario actualizado con éxito')->with('typealert', 'success');
            endif;
        endif;

    }
    
    // eliminar usuario
    public function getDeleteUser($id){
        $user = User::find($id);

        $user->delete();

        return back()->with('message', 'Usuario eliminado con éxito')->with('typealert', 'success');
    }
}
