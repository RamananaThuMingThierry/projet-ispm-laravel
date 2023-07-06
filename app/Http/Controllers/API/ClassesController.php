<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::all();
        return response()->json([
            'status' => 200,
            'classes' => $classes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'niveau_classes' => 'required|max:191',
        ]);

        if($validator->fails()){
            
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(), 
            ]);

        }else{
             
            $classes = new Classes;

            $classes->niveau_classes = $request->niveau_classes;
            
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
        $classe =  Classes::find($id);

        if($classe){
            return response()->json([
                'status' => 200,
                'classe' => $classe,
            ]);

        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Classes non Trouvé!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'niveau_classes' => 'required|max:191',
        ]);

        if($validator->fails()){    
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(), 
            ]);
        }else{

            $classe =  Classes::find($id);

            if($classe){
                $classe->niveau_classes = $request->niveau_classes;
                $classe->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Modification effectuée!',
                ]);

            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Classes non Trouvé!'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classe =  Classes::find($id);

        if($classe){
            $classe->delete();
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
