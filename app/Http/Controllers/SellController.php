<?php

namespace App\Http\Controllers;

use App\Models\SellModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        $id = $request->id;
        $product = SellModel::find($id);
        $product->delete();
        return response()->json([
            'message' => 'Sell deleted successfully'
        ]);
    }

    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function list(Request $request){
        //list all sell but join with UserModel by idclient and get only desneme and desemail, json decoode desproducts and join with ProductModel by idproduct and get only desproduct
        $sell = SellModel::with('user:id,desname,desemail')->get(['id','idclient','desproducts', 'created_at']);
      
        foreach($sell as $key => $value){
            $desproducts = json_decode($value->desproducts);
            //Verify if desproducts is array and if is array, iterate to get desproduct from ProductModel
            if(!empty($desproducts)){
                $products = [];
                foreach($desproducts as $value_){
                    //find from ProductModel and get only desname and desprice
                    $product = ProductModel::find($value_, ['desname','desprice']);
                    //format desprie to float
                    $product->desprice = floatval(str_replace(',', '.', str_replace('.', '', $product->desprice)));
                    $products[] = $product;
                }
            }
            $value->desproducts = json_encode($products);

      

        }
        return response()->json($sell);
    }

    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function create(Request $request){
        //set name of errors from validate in portuguese
        $messages = [
            'idclient.required' => 'O campo nome é obrigatório',
            'desproducts.required' => 'O campo preço é obrigatório',
        ];
        //validate if $request has all the required fields and send errors in json
        try {
            $this->validate($request, [
                'idclient' => 'required',
                'desproducts' => 'required',
            ], $messages);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }

       //create a new product
       $product = new SellModel();
       $product->idclient = $request->idclient;
       $product->desproducts = $request->desproducts;
       try {
         $product->save();
       } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao salvar este pedido, verifique se preencheu todos os campos corretamente!'], 500);
       }
        return response()->json(['message' => $product], 201);
    }
}
