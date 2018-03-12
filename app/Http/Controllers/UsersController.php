<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Validator;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'movil' => 'required'
        ]);

        $password = bcrypt($request->input('password'));
        $request->merge(['password' => $password]);
        $request->merge(['status' => 1]);
        $registro = User::create($request->all());

        return redirect()->route('users.index')->with('success', 'Registro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = User::find($id);
        return view('users.show', compact('registro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro = User::find($id);
        return view('users.edit', compact('registro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'unique:users,email,'.$request->id,
            'status' => 'required',
            'role_id' => 'required',
            'movil' => 'required'
        ]);

        if($request->input('password')) {
            $password = bcrypt($request->input('password'));
            $request->merge(['password' => $password]);
        }
        $registro = User::find($id);
        $registro->update($request->all());
        $registro->save();

        return redirect()->route('users.index')->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::destroy($id)) {
            return redirect()->route('users.index')->with('success', 'Registro eliminado correctamente');
        } else {
            return redirect()->route('users.index')->with('error', 'Registro no se pudo eliminar');
        }
    }

    public function data()
    {
        $tabla = DataTables::of( User::orderBy('created_at', 'DESC')->with('role'))
                ->addColumn('status', function($registro){
                    return $registro->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('role', function($registro){
                    $role = $registro->role != null ? $registro->role->name : '';
                    $movil = $registro->movil == 0 ? '<span class="badge badge-primary">Admin</span>' : '<span class="badge badge-warning">Movil</span>';
                    return $role.' '.$movil;
                })
                ->addColumn('action', function($registro){
                    $edit = '<a href="'.route('users.edit',$registro->id).'" class="edit btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
                    $show = '<a href="'.route('users.show',$registro->id).'" class="delete btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
                    return $edit . $show;
                })
                ->addIndexColumn()
                ->rawColumns(['role', 'action'])
                ->make(true);

        return $tabla;
    }
}
