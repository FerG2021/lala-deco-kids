<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth;
use App\Models\User; 

class ConnectController extends Controller
{
    // login
    public function getLogin(){
        return view('pages.connect.login');
    }

    public function postLogin(Request $request){
        $rules = [
            'userName' => 'required',
            'password' => 'required'
        ];

        $messages = [
            "userName.required" => 'Su nombre de usuario es requerido',
            'password.required' => 'Su contraseña es requerida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages); /**hacemos uso de validator mediante una variable que recibe como parametros todos los valores requeridos y laa reglas con las cuales debe validar esos datos */
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        else:
            if(Auth::attempt(['userName' => $request->input('userName'),'password' => $request->input('password')], true)): //podemos agregar true para que el usuario siempre este conectado
                return redirect('/home'); 
            else:
                return back()->with('message', 'Nombre de usuario o contraseña incorrecta')->with('typealert', 'alert alert-danger');
            endif;
        endif;
    }

    // logout
    public function getLogout(){
        Auth::logout();
        return redirect('/');
    }

    // registrar usuario
    public function getRegister(){
        return view('pages.connect.register');
    }

    public function postRegister(Request $request){
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
            'name.required' => 'Su nombre es requerido',
            'lastname.required' => 'Su apellido es requerido',
            //'email.required' => 'Su correo electrónico es requerido.',
            //'email.email' => 'El formato de su correo electrónico es inválido',
            //'email.unique' => 'Ya existe un usuario registrado con este correo electrónico',
            'userName' => 'Su nombre de usuario es requerido',
            'userName.unique' => 'Ya existe un usuario registrado con este nombre de usuario',
            'password.required' => 'Por favor, escriba una contraseña',
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
                return redirect('/login')->with('message', 'El usario se creo con éxito')->with('typealert', 'success');
            endif;
        endif;
    }


    // pagina principal
    public function getHome(){
        return view('pages.home');
    }
}
