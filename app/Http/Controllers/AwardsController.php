<?php

namespace App\Http\Controllers;

use App\Models\awards;
use Illuminate\Http\Request;

class AwardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $premios = awards::select('id', 'award')
            ->when($request->filter, function ($query) use ($request) {
                $query->where('award', 'LIKE', "%{$request->filter}%");
            })
            ->orderBy('award', 'ASC')
            ->with(['winner'])
            ->get();

        return response()->json([
            'data' => $premios
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'award' => 'required',
            ]);

            $premio = awards::create($request->all());
            return response()->json([
                'data' => $premio,
                'message' => 'se ha creado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Hubo un error al crear el premio',
                'code' => 400
            ]);
        }
    }

    public function show($id)
    {
        try {
            $premio = awards::findOrFail($id);

            return response()->json([
                'data' => $premio
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'premio no encontrado',
                'code' => 404
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $premio = awards::findOrFail($id);

            $request->validate([
                'award' => 'required',
            ]);

            $premio->fill($request->all())->save();

            return response()->json([
                'data' => $premio,
                'message' => 'se ha modificado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Hubo un error al modificar el premio',
                'code' => 400
            ]);
        }
    }

    public function destroy($id)
    {
        awards::destroy($id);
        return response()->json([
            'message' => 'Premio Eliminado exitosamente',
        ]);
    }
}
