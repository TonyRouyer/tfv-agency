<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;



class UserController extends Controller{
/**
* Update de l'utilisateur en se moment connecté en vérifiant le token (que le token lui apartienne bien)
* $user = @var int, @var string
* @param request lastname, firstname, mail , password, hash, avatar
* @param Json Retourne les infos du user avec le code HTML 200
*/
// maj avatar ne fonctionne pas
    public function UpdateUsers(Request $request){
        $this->validate($request, [
            'lastname' => 'string',
            'firstname' => 'string',
            'mail' => 'email|unique:user',
            'password' => 'confirmed',
        ]);
        if (Auth::check()){
        //Permet de vérifier si l'utilisateur est authentifié

        $user = Auth::user();
        $user->lastname = $request->input('lastname');
        $user->firstname = $request->input('firstname');
        $user->mail = $request->input('mail');
        $plainPassword = $request->input('password');
        //On hash le mot de passe
        $user->password = app('hash')->make($plainPassword);
        $user->avatar = $request->input('avatar');
        $user->id_tfv042119_role = 6;

        if ( !empty($request->input('lastname'))){
            $user->lastname = $request->input('lastname');
        }
        if (!empty($request->input('firstname'))){
            $user->firstname = $request->input('firstname');
        }
        if (!empty($request->input('mail'))){
            $user->mail = $request->input('mail');
        }
        if (!empty($request->input('password'))){
            $plainPassword = $request->input('password');
            //on hash le mot de passe
            $user->password = app('hash')->make($plainPassword);
        }
        $user->id_tfv042119_role = 6;
        $user->save();

               return response()->json($user, 200);
        }
    }
/**
* Met a jour l'avatar d'un utilisateur
* @param request avatar(type img)
* @param Json Retourne les infos lorsque la fonction est reussi
*/
    public function updateAvatar(Request $request){

        if (Auth::check()){
            //Permet de vérifier si l'utilisateur est authentifié

            $user = Auth::user();  
            


            $media = storage_path('app/avatar');



            $original_filename = $request->file('avatar')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);



            $image = 'U-' . time() . '.' . $file_ext;



            if ($request->file('avatar')->move($media, $image)) {
                $toto = $media . "/" . $user-> avatar;
                unlink($toto);
    

                $user->avatar = $image;
                $user->save();
                return response()->json($user->avatar, 200);
            } else {
                return response()->json('Cannot upload file',404);
            }

            

        }
    }

/**
* Met a jour le mot de passe pour la ligne qui corespond au mail
* @param request mail, password, paswword_confirmation
* @param Json Retourne les infos lorsque la fonction est reussi
*/
    public function passwordUpdatebyMail(Request $request) {
        $this->validate($request, [
            'password' => 'confirmed'
        ]);
        $mail = $request->input('mail');
        // on selectionne la ligne qui correspond a l'email
        $update = User::where('mail', $mail)->first();
                // ajouter fonction comparaison mot de passe avec l'actuel
        $plainPassword = $request->input('password');
        // on recupere et on hash le password
        $update->password = app('hash')->make($plainPassword);
        //on save en bdd
        $update->save();
        return response()->json($update, 200);   
    }
/**
* Met a jour le mot de passe pour la ligne au token de l'utilisateur
* @param request  password, paswword_confirmation
* @param Json Retourne les infos lorsque la fonction est reussi
*/
    public function passwordUpdate(Request $request) {
        $this->validate($request, [
            'password' => 'confirmed'
        ]);
        if (Auth::check()){
            //Permet de vérifier si l'utilisateur est authentifié
    
            $user = Auth::user();
            $plainPassword = $request->input('password');

            $user->password = app('hash')->make($plainPassword);
            $user->save();
            return response()->json($user, 200);   
        }

    }
//Permet de récupérer le profil d'un utilisateur en fonction de son TOKEN
    public function profile ()
    {
        return response()->json(['user' => Auth::user()], 200);
    }


    public function checkTokenValidity(){
        return response()->json(['valid' => Auth::check()]);
    }

    public function refreshToken(){
            $responseCode = 200;
            Auth::refresh();
            $response =  Auth::refresh();
            
            return response()->json($response, $responseCode);
        

        // $reponse =  response()->json( auth()->check() );
        // return var_dump($reponse);
        // // if($reponse == true) {
        // //     return 'token valide / ' ;
        // // }else if ($reponse == false) {
        // //     return 'token non valide / ';
        // // }
    }



/*
*
* PARTIE ADMIN
*
*/


//Insertion d'un employé seulement par l'admin ou par le chef d'agence grâce au middleware
    public function registerEmployee(Request $request)
    {
      //Validation de la requête entrante
      $this->validate($request, [
        'lastname' => 'required|string',
        'firstname' => 'required|string',
        'mail' => 'required|email|unique:user',
        'password' => 'required|confirmed',
        'avatar' => 'required',
        'id_tfv042119_role' => 'required',
      ]);

      try {
        //On instancie
        $user = new User;
        //Stock et récupére les données des INPUTs
        $user->lastname = $request->input('lastname');
        $user->firstname = $request->input('firstname');
        $user->mail = $request->input('mail');
        $plainPassword = $request->input('password');
        //On hash le mot de passe avec la "méthode make"
        $user->password = app('hash')->make($plainPassword);
        $user->avatar = $request->input('avatar');
        $user->id_tfv042119_role = $request->input('id_tfv042119_role');
        //Sauvegarde les données (les envois)
        $user->save();
        //Si succès, retourne le message de création de l'utilisateur
        return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

      } catch (\Exception $e) {
        //Retourne un message d'erreur
        return response()->json(['message' => 'Inscription non aboutie'], 409);
      }
    }

//Permet de récupérer la liste de tous les utlisateurs en fonction du TOKEN et retourne un code HTML 200
    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }

//Permet de récupérer un utlisateur en fonction du TOKEN et retourne un code HTML 200 ou 404
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'Utilisateur non trouvé !'], 404);
        }

    }
     
        //POST /user/{id}/avatar
        public function uploadAvatar(Request $request, User $user) {
            $file = $request->file('file');
            
            $fileEntry = $this->storeFileEntry($file, $user);
            
            $user->avatar_id = $fileEntry->id;
            $user->save();
        }

    public function showPhoto(Request $request) {
        try{
            $avatar = $request->input('avatarName');
            $path = storage_path('app/avatar/' . $avatar); 
            // if (!File::exists($path)) { 
            //     abort(404); 
            // } 
            $file = base64_encode(File::get($path)); 
            $type = File::mimeType($path);
            return response()->json(['file' => $file, 'type' => $type]);
        } catch (ModelNotFoundException $e) {
            return response()->json('Une erreur est survenue durant la récupération de la photo', 500);
        }
    }
        
}
