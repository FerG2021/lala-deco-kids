<?php

namespace App\Http\Controllers;

use App\Http\Models\Client;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use Carbon\Carbon;

class ClientController extends Controller
{
    // agregar nuevo cliente en ventas
    public function postAddNewClientSale(Request $request){
        $rules = [
            'dniclient' => 'required|unique:App\Http\Models\Client,dniClient',            
            'nameclient' => 'required', 
            'lastnameclient' => 'required', 
            'directionclient' => 'required',
            'phoneclient' => 'required',                  
        ];

        $messages = [
            'dniclient.required' => 'El DNI del cliente es requerido',   
            'dniclient.unique' => 'Ya existe un cliente registrado con el DNI ingresado',         
            'nameclient.required' => 'El nombre del cliente es requerido',
            'lastnameclient.required' => 'El apellido del cliente es requerido',
            'directionclient.required' => 'La direccion del cliente es requerida',
            'phoneclient.required' => 'El telefono del cliente es requerido',            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            // guardo el cliente
            $client = new Client();

            $client->dniClient = $request->get('dniclient');
            $client->nameClient = $request->get('nameclient');
            $client->lastNameClient = $request->get('lastnameclient');
            $client->directionClient = $request->get('directionclient');
            $client->phoneClient = $request->get('phoneclient');

            if ($request->get('mailclient') != null) {
                $client->mailClient = $request->get('mailclient');
            } else {
                $client->mailClient = '---';
            }

            if ($client->save()) {
                return back()->with('message', 'Cliente añadido con éxito')->with('typealert', 'alert alert-success');
            } else {
                # code...
            }
        }
    }

    // agregar nuevo cliente
    public function getAddNewClient(){
        return view('pages.client.addclient');
    }

    public function postAddNewClient(Request $request){
        $rules = [
            'dniclient' => 'required|unique:App\Http\Models\Client,dniClient',
            'nameclient' => 'required', 
            'lastnameclient' => 'required', 
            'directionclient' => 'required',
            'phoneclient' => 'required',                  
        ];

        $messages = [
            'dniclient.required' => 'El DNI del cliente es requerido',  
            'dniclient.unique' => 'Ya existe un cliente registrado con el DNI ingresado',                
            'nameclient.required' => 'El nombre del cliente es requerido',
            'lastnameclient.required' => 'El apellido del cliente es requerido',
            'directionclient.required' => 'La direccion del cliente es requerida',
            'phoneclient.required' => 'El telefono del cliente es requerido',            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            // guardo el cliente
            $client = new Client();

            $client->dniClient = $request->get('dniclient');
            $client->nameClient = $request->get('nameclient');
            $client->lastNameClient = $request->get('lastnameclient');
            $client->directionClient = $request->get('directionclient');
            $client->phoneClient = $request->get('phoneclient');

            if ($request->get('mailclient') != null) {
                $client->mailClient = $request->get('mailclient');
            } else {
                $client->mailClient = '---';
            }

            if ($client->save()) {
                return back()->with('message', 'Cliente añadido con éxito')->with('typealert', 'alert alert-success');
            } else {
                # code...
            }
        }
    }

    // lista de clientes
    public function getListClient(){
        $clients = Client::orderBy('lastNameClient', 'asc')->get();

        return view('pages.client.listclients')->with('clients', $clients);
    }

    // editar cliente
    public function getEditClient($id){
        $client = Client::find($id);

        return view('pages.client.editclient')->with('client', $client);
    }

    public function postEditClient(Request $request, $id){
        $rules = [
            'dniclient' => 'required',
            'nameclient' => 'required', 
            'lastnameclient' => 'required', 
            'directionclient' => 'required',
            'phoneclient' => 'required',                  
        ];

        $messages = [
            'dniclient.required' => 'El DNI del cliente es requerido',                         
            'nameclient.required' => 'El nombre del cliente es requerido',
            'lastnameclient.required' => 'El apellido del cliente es requerido',
            'directionclient.required' => 'La direccion del cliente es requerida',
            'phoneclient.required' => 'El telefono del cliente es requerido',            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            $client = Client::find($id);

            $client->dniClient = $request->get('dniclient');
            $client->nameClient = $request->get('nameclient');
            $client->lastNameClient = $request->get('lastnameclient');
            $client->directionClient = $request->get('directionclient');
            $client->phoneClient = $request->get('phoneclient');
    
            if ($request->get('mailclient') != null) {
                $client->mailClient = $request->get('mailclient');
            } else {
                $client->mailClient = '---';
            }
    
            if ($client->save()) {
                return redirect('client/listclient')->with('message', 'Cliente actualizado con éxito')->with('typealert', 'alert alert-success');
            } else {
                # code...
            }
        }
    }

    public function getDeleteClient($id){
        $client = Client::find($id);

        $client->delete();

        return back()->with('message', 'Cliente eliminado con éxito')->with('typealert', 'alert alert-success');
    }
}
