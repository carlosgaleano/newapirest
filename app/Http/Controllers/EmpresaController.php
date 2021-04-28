<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

/**
 * Class EmpresaController
 * @package App\Http\Controllers
 */
class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::paginate();

        return view('empresa.index', compact('empresas'))
            ->with('i', (request()->input('page', 1) - 1) * $empresas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {

        //ddd($request);


        $request->validate([
            'nombre' => 'required|string|max:50',
            'direccion' => 'required|string'
        ]);

        try {
            //code...
            Empresa::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,

            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'Error no se pudo crear!',
                'excepcion' => $th,
            ], 501);
        }



        return response()->json([
            'message' => 'Successfully created Empresa!'
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Empresa::$rules);

        $empresa = Empresa::create($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::find($id);

        return view('empresa.show', compact('empresa'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showALL()
    {
        $empresa = Empresa::all();
      //  $empresa= Empresa::paginate();

        return response()->json($empresa);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresa::find($id);

        return view('empresa.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //request()->validate(Empresa::$rules);

//dd($request);

       // dd( $request->post('id'));

        try {
            //code...

            $id = $request->id;
            $empresa = Empresa::findOrFail($id);
            $empresa->nombre = $request->nombre;
            $empresa->direccion = $request->direccion;
            $empresa->update();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'No se puedo actualizar',
                'exception' => $th
            ], 501);
        }



        return response()->json([
            'message' => 'Successfully direccion actually'
        ], 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {

        try {
            //code...
            $empresa = Empresa::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'No se pudo Eliminar',
                'exception' => $th
            ], 501);
        }

        return response()->json([
            'message' => 'Successfully delete Empresa'
        ], 201);
    }
}
