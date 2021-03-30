<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
// Importation des Auth dans les façades
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  public function register(Request $request)
  {
    /**
     * fonction register
     * Validation provenant de la requête
     * @param Request lastname, firtsname, mail, password, avatar
     */
    
    $this->validate($request, [
      'lastname' => 'required|string',
      'firstname' => 'required|string',
      'mail' => 'required|email|unique:user',
      'password' => 'required|confirmed',
    ]);
    try {
     /**
     * On instancie User
     * @param Request lastname, firtsname, mail, password, avatar
     * @param User TOKEN in header
     * @return json Retourne les infos du RDV avec le message de confirmation et le code HTML 201 ou 409
     */
      $user = new User;
      //stock et récupére les données des INPUTs
      $user->lastname = $request->input('lastname');
      $user->firstname = $request->input('firstname');
      $user->mail = $request->input('mail');
      $plainPassword = $request->input('password');
      //on hash le mot de passe avec la "méthode make"
      $user->password = app('hash')->make($plainPassword);
      $media = storage_path('app/avatar');
      if ($request->hasFile('a')) {
        $original_filename = $request->file('a')->getClientOriginalName();
        $original_filename_arr = explode('.', $original_filename);
        $file_ext = end($original_filename_arr);
        $destination_path = './upload/userAvatar/';
        $image = 'U-' . time() . '.' . $file_ext;

        if ($request->file('a')->move($media, $image)) {

            $user->avatar = $image;
        } else {
            return response()->json('Cannot upload file',404);
        }
      } else {
          $user->avatar = 'exemple.png';
      }
      $user->rental = 0;
      $user->owner = 0;
      $user->id_tfv042119_role = 6;
      //sauvegarde les données (les envoies)
      $user->save();

      //retourne la réponse si c'est un succès
      return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

    } catch (\Exception $e) {
      //sinon retourne un message d'erreur
      return response()->json(['message' => 'Inscription non aboutie'], 409);
    }

  }

  public function login(Request $request)
  {
    /**
     * fonction login
     * Validation provenant de la requête
     * @param Request mail, password
     * @param User TOKEN in header
     * @return json Retourne les infos du RDV avec le message de confirmation et le code HTML 401
     */
    $this->validate($request, [
      'mail' => 'required|string',
      'password' => 'required|string',
    ]);
    //stockage dans $credentials le mail et password
    $credentials = $request->only(['mail', 'password']);
    //si l'authentification est réussie, stockage du TOKEN dans $token et nous retourne la fonction respondWithToken, sinon affichage d'un message d'erreur avec le code HTTP 401
    if (! $token = Auth::attempt($credentials)) {
      return response()->json(['message' => 'Unauthorized'], 401);
    }
    return $this->respondWithToken($token);
  }
}
