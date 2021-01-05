<?php
namespace App\Http\Controllers;

use App\Models\realEstate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class houseController extends Controller {
    // retourne la liste des maison en vente au format JSON
    public function getHouseSaleList(){
        $house = realEstate::where('houseApartment', 0)
        ->where('SaleOrRental', 0)
        ->get();
        return response()->json($house);
    }
    // retourne la liste des maison en location au format JSON
    public function getHouseRentalList(){
        $house = realEstate::where('houseApartment', 0)
        ->where('SaleOrRental', 1)
        ->get();
        return response()->json($house);
    }
    /**
     * retourne la liste des maison en vente selon des filtres, au format JSON
     *
     *ordre : priceMin,PriceMax,referencePublishing,city,zip,areaMin,areaMax,numberOFPieceMin,numberOfPieceMAx,digicode,furniture,balcony,elevator,garden,garage,parking,cellar
    *
    * @param string contient la liste de tout les parametre dans l'odre ci-dessus
    *
    * @return void
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
        return $house->get();
    }
    /**
     * retourne la liste des maison en location selon des filtres, au format JSON
     *
     *ordre : priceMin,PriceMax,referencePublishing,city,zip,areaMin,areaMax,numberOFPieceMin,numberOfPieceMAx,digicode,furniture,balcony,elevator,garden,garage,parking,cellar
    *
    * @param string contient la liste de tout les parametre dans l'odre ci-dessus
    *
    * @return void
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
        return $house->get();
    }
}