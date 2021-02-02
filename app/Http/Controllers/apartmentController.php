<?php
namespace App\Http\Controllers;

use App\Models\apartment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class apartmentController extends Controller{
     /**
     * function getApartmentSaleList
     *retourne la liste des appartements en vente au format JSON
     * @return json Retourne la liste des appartements en vente et le code HTTP 200 
     */
    public function getApartmentSaleList(){
        $house = apartment::where('houseApartment', 1)
        ->where('owner', 1)
        ->get();
        return response()->json(['saleApartementList' => $house], 200);
    }
     /**
     * function getApartmentRentalList
     * Retourne la liste des appartements en location au format JSON
     * @return json Retourne la liste des appartements en vente et le code HTTP 200 
     */
    public function getApartmentRentalList(){
        $house = apartment::where('houseApartment', 1)
        ->where('rental', 1)
        ->get();
        return response()->json(['rentalApartementList' => $house], 200);
    }
     /**
     * fonction getApartmentSaleFilter
     * Récupère la liste de tous les appartements en vente filtrée au format numérique sauf le 0 qui ne filtre pas.
     * avec dans l'ordre : 
     * @param Request priceMin, priceMax, referencePublishing, city, zip (n° département), areaMin, areaMax, numberOFPieceMin, numberOfPieceMAx, digicode, furniture, balcony, elevator, garden, garage, parking, cellar
     * @return json Retourne la liste des appartements trouvée et le code HTTP 200 
     */
    public function getApartmentSaleFilter($search){
            $explodeSearch = explode(',', $search);
            $house = apartment::where('houseApartment', 1)->where('SaleOrRental', 0);
            if ($explodeSearch[0] >= 0 && $explodeSearch[0] < $explodeSearch[1]) {
                $house->where('price', '>=' , $explodeSearch[0]);
            }
            if ($explodeSearch[1] != 0 && $explodeSearch[1] > $explodeSearch[0]) {
                $house->where('price', '<=' , $explodeSearch[1]);
            }
            if ($explodeSearch[2] != 0) {
                $house->where('referencePublishing', '=' , $explodeSearch[2]);
            }
            if ($explodeSearch[3] != 0) {
                $house->where('city', '=' , $explodeSearch[3]);
            }
            if ($explodeSearch[4] != 0) {
                $house->where('zip', '=' , $explodeSearch[4]);
            }
            if ($explodeSearch[5] != 0) {
                $house->where('area', '>=' , $explodeSearch[5]);
            }
            if ($explodeSearch[6] != 0) {
                $house->where('area', '<=' , $explodeSearch[6]);
            }
            if ($explodeSearch[7] != 0) {
                $house->where('numberOfPieces', '>=' , $explodeSearch[7]);
            }
            if ($explodeSearch[8] != 0) {
                $house->where('numberOfPieces', '<=' , $explodeSearch[8]);
            }
            if ($explodeSearch[9] != 0) {
                $house->where('digicode', '=' , 1);
            }
            if ($explodeSearch[10] != 0) {
                $house->where('furniture', '=' , 1);
            }
            if ($explodeSearch[11] != 0) {
                $house->where('balcony', '=' , 1);
            }
            if ($explodeSearch[12] != 0) {
                $house->where('elevator', '=' , 1);
            }
            if ($explodeSearch[13] != 0) {
                $house->where('garden', '=' , 1);
            }
            if ($explodeSearch[14] != 0) {
                $house->where('garage', '=' , 1);
            }
            if ($explodeSearch[15] != 0) {
                $house->where('parking', '=' , 1);
            }
            if ($explodeSearch[16] != 0) {
                $house->where('cellar', '=' , 1);
            }
            $result = $house->get();
            return response()->json(['saleApartement' => $result], 200);
        }
     /**
     * fonction getApartmentRentalFilter
     * Récupère la liste de tous les appartements en location filtrée au format numérique sauf le 0 qui ne filtre pas
     * avec dans l'ordre : 
     * @param Request priceMin, PriceMax, referencePublishing, city, zip (N° de département), areaMin, areaMax, numberOFPieceMin, numberOfPieceMAx, digicode, furniture, balcony, elevator, garden, garage, parking, cellar
     * @return json Retourne la liste des appartements trouvée et le code HTTP 200
     */
    public function getApartmentRentalFilter($search){
        //'Exemple : recherche d'une maison, au prix de 250000€ avec une surface comprise entre 30m2 et 100m2 avec au moins 1 pièce, meublé avec escalier'
        //'=> 0,250000,0,0,0,30,100,1,0,0,1,0,1,0,0,0,0'
        $explodeSearch = explode(',', $search);
        $house = apartment::where('houseApartment', 1)->where('SaleOrRental', 1);
        if ($explodeSearch[0] >= 0 && $explodeSearch[0] < $explodeSearch[1]) {
            $house->where('price', '>=' , $explodeSearch[0]);
        }
        if ($explodeSearch[1] != 0 && $explodeSearch[1] > $explodeSearch[0]) {
            $house->where('price', '<=' , $explodeSearch[1]);
        }
        if ($explodeSearch[2] != 0) {
            $house->where('referencePublishing', '=' , $explodeSearch[2]);
        }
        if ($explodeSearch[3] != 0) {
            $house->where('city', '=' , $explodeSearch[3]);
        }
        if ($explodeSearch[4] != 0) {
            $house->where('zip', '=' , $explodeSearch[4]);
        }
        if ($explodeSearch[5] != 0) {
            $house->where('area', '>=' , $explodeSearch[5]);
        }
        if ($explodeSearch[6] != 0) {
            $house->where('area', '<=' , $explodeSearch[6]);
        }
        if ($explodeSearch[7] != 0) {
            $house->where('numberOfPieces', '>=' , $explodeSearch[7]);
        }
        if ($explodeSearch[8] != 0) {
            $house->where('numberOfPieces', '<=' , $explodeSearch[8]);
        }
        if ($explodeSearch[9] != 0) {
            $house->where('digicode', '=' , 1);
        }
        if ($explodeSearch[10] != 0) {
            $house->where('furniture', '=' , 1);
        }
        if ($explodeSearch[11] != 0) {
            $house->where('balcony', '=' , 1);
        }
        if ($explodeSearch[12] != 0) {
            $house->where('elevator', '=' , 1);
        }
        if ($explodeSearch[13] != 0) {
            $house->where('garden', '=' , 1);
        }
        if ($explodeSearch[14] != 0) {
            $house->where('garage', '=' , 1);
        }
        if ($explodeSearch[15] != 0) {
            $house->where('parking', '=' , 1);
        }
        if ($explodeSearch[16] != 0) {
            $house->where('cellar', '=' , 1);
        }
        $result = $house->get();
        return response()->json(['rentalApartement' => $result], 200);
        }
}