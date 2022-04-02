<?php

namespace App\Http\Controllers;

use App\Models\winners;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;

class WinnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ganadores = winners::all();
        return response()->json([
            'data' => $ganadores,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address' => 'required',
                'awards_id' => 'required|unique:winners',
            ]);

            $ganador = winners::create($request->all());
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'mesagge' => 'NO se creo el ganador',
                'code' => '400',
            ]);
        }
    }
    public function show($id)
    {
        try {
            $ganador = winners::FindOrFail($id);
            return response()->json([
                'data' => $ganador,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensagge' => 'no se ha encontrado un ganador',
                'code' => 404
            ]);
        }
    }

    public function update(request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address' => 'required',
                'awards_id' => 'required|unique:winners',
            ]);
            $ganador = winners::FindOrFail($id);
            $ganador->fill($request->all())->save();
        } catch (\Exception $e) {
            return response()->json([
                'mesagge' => 'No Se Modifico el Ganador',
                'code' => 400
            ]);
        }
    }
    public function destroy($id)
    {
        winners::destroy($id);
        return response()->json([
            'mesagge' => 'se elimino correctamente',
        ]);
    }
}
