<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Validator;
use App\Customers;

class CustomersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            'code' => 'required|max:255|unique:customers,code',
            'name' => 'required',
            'trade_name' => 'required',
            'business_name' => 'required',
            'address' => 'required'
        ]);
        
        $request->merge(['status' => 1]);
        $registro = Customers::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Registro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = Customers::find($id);
        return view('customers.show', compact('registro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro = Customers::find($id);
        return view('customers.edit', compact('registro'));
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
            'code' => 'required|max:255|unique:customers,code,'.$request->id,
            'name' => 'required',
            'trade_name' => 'required',
            'business_name' => 'required',
            'address' => 'required',
            'status' => 'required'
        ]);

        $registro = Customers::find($id);
        $registro->update($request->all());
        $registro->save();

        return redirect()->route('customers.index')->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Customers::destroy($id)) {
            return redirect()->route('customers.index')->with('success', 'Registro eliminado correctamente');
        } else {
            return redirect()->route('customers.index')->with('error', 'Registro no se pudo eliminar');
        }
    }

    public function data()
    {
        $tabla = DataTables::of( Customers::orderBy('created_at', 'DESC') )
                ->addColumn('status', function($registro){
                    return $registro->status == 1 ? 'Activo' : 'Suspendido';
                })
                ->addColumn('action', function($registro){
                    $edit = '<a href="'.route('customers.edit',$registro->id).'" class="edit btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
                    $show = '<a href="'.route('customers.show',$registro->id).'" class="delete btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
                    return $edit . $show;
                })
                ->addIndexColumn()
                ->make(true);

        return $tabla;
    }
}
