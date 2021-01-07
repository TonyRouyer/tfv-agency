<?php
namespace App\Http\Controllers;

use App\Models\realEstate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class houseController extends Controller {
     /**
     * function getHouseSaleList
     *retourne la liste des maison en vente au format JSON
     * @return json 
     */
    public function getHouseSaleList(){
        $house = realEstate::where('houseApartment', 0)
        ->where('SaleOrRental', 0)
        ->get();
        return response()->json(['saleApartementList' => $house], 200);
    }
     /**
     * function getHouseRentalList
     *retourne la liste des maison en location au format JSON
     * @return json 
     */
    public function getHouseRentalList(){
        $house = realEstate::where('houseApartment', 0)
        ->where('SaleOrRental', 1)
        ->get();
        return response()->json(['saleApartementList' => $house], 200);
    }
     /**
     * function getHouseSaleFilter
     * Recupère la liste de toute les maison en vente d'apres divers filtres sous forme de chiffre, 0 ne prend pour ne pas prendre en compte le filtres
     * avec dans l'ordre : 
     * @param Request priceMin,PriceMax,referencePublishing,city,zip,areaMin,areaMax,numberOFPieceMin,numberOfPieceMAx,digicode,furniture,balcony,elevator,garden,garage,parking,cellar
     * @return json avec la liste des apartement trouvé
     */  
    public function getHouseSaleFilter($search){
        $explodeSearch = explode(',', $search);
        $house = realEstate::where('houseApartment', 0)->where('SaleOrRental', 0);
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
        return response()->json(['saleHouse' => $result], 200);
    }
     /**
     * function getHouseRentalFilter
     * Recupère la liste de toute les maison en location d'apres divers filtres sous forme de chiffre, 0 ne prend pour ne pas prendre en compte le filtres
     * avec dans l'ordre : 
     * @param Request priceMin,PriceMax,referencePublishing,city,zip,areaMin,areaMax,numberOFPieceMin,numberOfPieceMAx,digicode,furniture,balcony,elevator,garden,garage,parking,cellar
     * @return json avec la liste des apartement trouvé
     */  
    public function getHouseRentalFilter($search){
        $explodeSearch = explode(',', $search);
        $house = realEstate::where('houseApartment', 0)->where('SaleOrRental', 1);
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
        return response()->json(['rentalHouse' => $result], 200);
    }
}