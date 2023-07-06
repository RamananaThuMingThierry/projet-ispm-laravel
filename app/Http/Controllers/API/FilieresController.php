<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Filieres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilieresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filieres::all();
        return response()->json([
            'status' => 200,
            'filieres' => $filieres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_filieres' => 'required|max:191',
            'sigle_filieres' => 'required|max:191',
            'classes_id' => 'required|191'
        ]);

        if($validator->fails()){
            
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(), 
            ]);

        }else{
             
            $filieres = new Filieres;

            $filieres->nom_filieres = $request->nom_filieres;
            $filieres->sigle_filieres = $request->filieres;
            $filieres->classes_id = $request->classes_id;
            
            return response()->json([
                'status' => 200,
                'message' => 'L\'enregistrement a été bien effectuée!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $filiere =  Filieres::find($id);

        if($filiere){
            return response()->json([
                'status' => 200,
                'filiere' => $filiere,
            ]);

        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Filière non Trouvé!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom_filieres' => 'required|max:191',
            'sigle_filieres' => 'required|max:191',
            'classes_id' => 'required|191'
        ]);

        if($validator->fails()){
            
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(), 
            ]);

        }else{

            $filiere =  Filieres::find($id);

            if($filiere){
                $filiere->nom_filieres = $request->nom_filieres;
                $filiere->sigle_filieres = $request->sigle_filieres;
                $filiere->classes_id = $request->classes_id;
                $filiere->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Modification effectuée!',
                ]);

            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Filière non Trouvé!'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $filiere =  Filieres::find($id);

        if($filiere){
            $filiere->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Suppression a été bien effectuée!',
            ]);

        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Classes non Trouvé!'
            ]);
        }
    }
}
