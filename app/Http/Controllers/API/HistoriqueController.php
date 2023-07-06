<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historique = Historique::all();
        return response()->json([
            'status' => 200,
            'historique' => $historique
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'required',
            'entrer' => 'required|date',
            'sortir' => 'required|date'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(), 
            ]);

        }else{
             
            $historique = new Historique;

            $historique->numero = $request->numero;
            $historique->entrer = $request->entrer;
            $historique->sortir = $request->sortir;
            
            $historique->save();

            return response()->json([
                'status' => 200,
                'message' => 'Enregistrement effectuée!',
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'required',
            'entrer' => 'required|date',
            'sortir' => 'required|date'
        ]);

        if($validator->fails()){    
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(), 
            ]);

        }else{
            $historique = Historique::find($id);

            if($historique){
                
                $historique-> save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Modification effectuée!',
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Product Not Found'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Historique $historique)
    {
        //
    }
}
