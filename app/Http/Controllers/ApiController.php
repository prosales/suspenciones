<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\User;
use Exception;
use Auth;

class ApiController extends Controller
{
    public $statusCode = 200;
    public $records = null;
    public $message = "Oops! Algo salio mal.";
    public $result = false;

    public function Login(Request $request)
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $request->merge(['movil' => 1]);
            $registro = User::where('email', $email)->first();
            if($registro) {
                $credentials = Auth::attempt($request->all());
                if(!$credentials) {
                    $this->result = false;
                    $this->message = 'Credenciales incorrectas.';
                }
                else {
                    $this->records = Auth::user();
                    $this->result = true;
                    $this->message = "Bienvenido.";
                }
            }
            else {
                $this->message = 'El usuario ingresado no existe.';
                $this->result = false;
            }
        }
        catch(Exception $e) {
            $this->message = env('AMBIENTE') ? 'Ocurrio un problema al consultar registro.' : $e->getMessage();
            $this->result = false;
        }
        finally {
            $response  = [
                'result' => $this->result,
                'message' => $this->message,
                'records' => $this->records
            ];

            return response()->json($response, $this->statusCode);
        }
    }

    public function SearchCustomer(Request $request)
    {
        try {
            $code = $request->input('code');
            $registro = Customers::where('code', $code)->first();
            if($registro) {
                $registro->status = $registro->status == 1 ? 'Activo' : 'Suspendido';
                $this->message = 'Consulta exitosa.';
                $this->result = true;
                $this->records = $registro;
            }
            else {
                $this->message = 'Código ingresado no válido o no existe.';
                $this->result = false;
            }
        }
        catch(Exception $e) {
            $this->message = env('AMBIENTE') ? 'Ocurrio un problema al consultar registro.' : $e->getMessage();
            $this->result = false;
        }
        finally {
            $response  = [
                'result' => $this->result,
                'message' => $this->message,
                'records' => $this->records
            ];

            return response()->json($response, $this->statusCode);
        }
    }
}
