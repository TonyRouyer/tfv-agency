<?php
namespace App\Http\Controllers;

use App\Models\apartment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class apartmentController extends Controller{
     /**
     * function getApartmentSaleList
     *retourne la liste des appartement en vente au format JSON
     * @return json 
     */
    public function getApartmentSaleList(){
        $house = apartment::where('houseApartment', 1)
        ->where('owner', 1)
        ->get();
        return response()->json(['saleApartementList' => $house], 200);
    }
     /**
     * function getApartmentRentalList
     *retourne la liste des appartement en location au format JSON
     * @return json 
     */
    public function getApartmentRentalList(){
        $house = apartment::where('houseApartment', 1)
        ->where('rental', 1)
        ->get();
        return response()->json(['rentalApartementList' => $house], 200);
    }
     /**
     * function getApartmentSaleFilter
     * Recupère la liste de toute les appartement en vente d'apres divers filtres sous forme de chiffre, 0 ne prend pour ne pas prendre en compte le filtres
     * avec dans l'ordre : 
     * @param Request priceMin,PriceMax,referencePublishing,city,zip,areaMin,areaMax,numberOFPieceMin,numberOfPieceMAx,digicode,furniture,balcony,elevator,garden,garage,parking,cellar
     * @return json avec la liste des apartement trouvé
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
     * function getApartmentRentalFilter
     * Recupère la liste de toute les appartement en location d'apres divers filtres sous forme de chiffre, 0 ne prend pour ne pas prendre en compte le filtres
     * avec dans l'ordre : 
     * @param Request priceMin,PriceMax,referencePublishing,city,zip,areaMin,areaMax,numberOFPieceMin,numberOfPieceMAx,digicode,furniture,balcony,elevator,garden,garage,parking,cellar
     * @return json avec la liste des apartement trouvé
     */
    public function getApartmentRentalFilter($search){
        //'0,250000,0,0,0,30,100,1,0,0,1,0,1,0,0,0,0'
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