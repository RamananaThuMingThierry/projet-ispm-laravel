<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Etudiants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiants::all();
        return response()->json([
            'status' => 200,
            'etudiants' => $etudiants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filieres_id' => 'required|max:191',
            'nom_etudiants' => 'required|max:191',
            'prenom_etudiants' => 'required|max:191',
            'ddn_etudiants' => 'required|max:191',
            'ldn_etudiants' => 'required|max:191',
            'sexe' => 'required|max:20',
            'contact_etudiants' => 'required|max:20',
            'email_etudiants' => 'required|max:20',
            'adresse_etudiants' => 'required|max:4',
            'numMatriculeMoto' => 'required|max:20',
            'code_barre' => 'required',
            'documents' => 'required',
            'image_etudiants' => 'required|mimes:jpeg,jpg,png|max:2048|image',
        ]);

        if($validator->fails()){
            
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(), 
            ]);

        }else{
             
            $etudiants = new Etudiants;

            $etudiants->filieres_id = $request->filieres_id;
            $etudiants->nom_etudiants = $request->nom_etudiants;
            $etudiants->prenom_etudiants= $request->prenom_etudiants;
            $etudiants->ddn_etudiants = $request->ddn_etudiants;
            $etudiants->ldn_etudiants = $request->ldn_etudiants;
            $etudiants->sexe = $request->sexe;
            $etudiants->contact_etudiants = $request->contact_etudiants;
            $etudiants->email_etudiants = $request->email_etudiants;
            $etudiants->adresse_etudiants = $request->adresse_etudiants;
            $etudiants->numMatriculeMoto = $request->numMatriculeMoto;
            $etudiants->code_barre = $request->code_barre;
            $etudiants->documents = $request->documents;

            if($request->hasFile("image_etudiants")){
                $file = $request->file('image_etudiants');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move("uploads/etudiants/", $filename);
                $etudiants->image_etudiants = 'uploads/etudiants/'.$filename;
            }
            
            $etudiants->save();

            return response()->json([
                'status' => 200,
                'message' => 'Enregistrement effectuée!',
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $etudiant = Etudiants::find($id);
        
        if($etudiant){
            
            return response()->json([
                'status' => 200,
                'etudiant' => $etudiant
            ]);
            
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Etudiant non trouvé!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'filieres_id' => 'required|max:191',
            'nom_etudiants' => 'required|max:191',
            'prenom_etudiants' => 'required|max:191',
            'ddn_etudiants' => 'required|max:191',
            'ldn_etudiants' => 'required|max:191',
            'sexe' => 'required|max:20',
            'contact_etudiants' => 'required|max:20',
            'email_etudiants' => 'required|max:20',
            'adresse_etudiants' => 'required|max:4',
            'numMatriculeMoto' => 'required|max:20',
            'documents' => 'required',
            'code_barre' => 'required',
            'image_etudiants' => 'required|mimes:jpeg,jpg,png|max:2048|image',
        ]);

        if($validator->fails()){    
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(), 
            ]);
        }else{

            $etudiant =  Etudiants::find($id);

            if($etudiant){
                $etudiant->filieres_id = $request->filieres_id;
                $etudiant->nom_etudiants = $request->nom_etudiants;
                $etudiant->prenom_etudiants= $request->prenom_etudiants;
                $etudiant->ddn_etudiants = $request->ddn_etudiants;
                $etudiant->ldn_etudiants = $request->ldn_etudiants;
                $etudiant->sexe = $request->sexe;
                $etudiant->contact_etudiants = $request->contact_etudiants;
                $etudiant->email_etudiants = $request->email_etudiants;
                $etudiant->adresse_etudiants = $request->adresse_etudiants;
                $etudiant->numMatriculeMoto = $request->numMatriculeMoto;
                $etudiant->code_barre = $request->code_barre;
                $etudiant->documents = $request->documents;

                if($request->hasFile("image_etudiants")){
                    $path = $etudiant->image_etudiants;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                    $file = $request->file('image_etudiants');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move("uploads/etudiants/", $filename);
                    $etudiant->image_etudiants = 'uploads/etudiants/'.$filename;
                }
                
                $etudiant-> save();

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
    
    public function destroy($id)
    {
        $etudiant = Etudiants::find($id);
        
        if($etudiant){
            $etudiant->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Suppression a été bien effectuée!'
            ]);
            
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Etudiant non trouvé!'
            ]);
        }
    }
}
