<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

<<<<<<< HEAD
class UserController extends Controller{
/**
* Update de l'utilisateur en se moment connecté en vérifiant le token (que le token lui apartienne bien)
=======
class UserController extends Controller
{

//Update de l'utilisateur connecté actuellement en vérifiant le TOKEN (que le TOKEN lui appartienne bien)

/**
* Fonction pour update l'utilisateur
>>>>>>> 90a0b1504ee74ee4fbd46c36c12aaf815034649b
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
<<<<<<< HEAD
         //permet de verifier si l'utilisateur est authentifié
        $user = Auth::user();
=======
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
>>>>>>> 90a0b1504ee74ee4fbd46c36c12aaf815034649b

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
        if ($request->hasFile('a')) {
            $original_filename = $request->file('a')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/userAvatar/';
            $image = 'U-' . time() . '.' . $file_ext;

            if ($request->file('a')->move($destination_path, $image)) {
                //$fileToDelete = '../assets/img/avatar/' .  $userInfo->avatar;
                //unlink($fileToDelete);
                $user->avatar = $image;
            } else {
                return response()->json('Cannot upload file',404);
            }
        } else {
              $user->avatar = 'exemple.png';
        }
        $user->id_tfv042119_role = 6;
        $user->save();

               return response()->json($user, 200);
        }
    }

//Permet de récupérer le profil d'un utilisateur en fonction de son TOKEN
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
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
     
<<<<<<< HEAD

=======
        //POST /user/{id}/avatar
        public function uploadAvatar(Request $request, User $user) {
            $file = $request->file('file');
            
            $fileEntry = $this->storeFileEntry($file, $user);
            
            $user->avatar_id = $fileEntry->id;
            $user->save();
        }
>>>>>>> 90a0b1504ee74ee4fbd46c36c12aaf815034649b
        
}
