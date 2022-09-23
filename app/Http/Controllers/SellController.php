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
     * @expects {id}
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        $id = $request->id;
        /**
         * @param id
         * @return ProductModel
        */ 
        try {
            $product = SellModel::find($id);
        } catch (\Throwable $th) {
           throw new \Exception("Produto de id {$id} não encontrado");
        }
        /**
         * @var ProductModel $product
         * @return {?} Exception
        */
        try {
            $product->delete();
        } catch (\Throwable $th) {
           throw new \Exception("Erro ao deletar a venda de id {$id}");
        }
        return response()->json([
            'message' => 'Venda deletada com successo.'
        ]);
    }
    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function list(Request $request){
        //@method GET
        /**
         * @param null
         * @return \Illuminate\Http\JsonResponse
        */
        $sell = SellModel::with('user:id,desname,desemail')->get(['id','idclient','desproducts', 'created_at']);
        foreach($sell as $key => $value){
            $desproducts = json_decode($value->desproducts);
            //Verify if desproducts is array and if is array, iterate to get desproduct from ProductModel
            if(!empty($desproducts)){
                $products = [];
                foreach($desproducts as $value_){
                    //find from ProductModel and get only desname and desprice
                    try {
                        $product = ProductModel::find($value_, ['desname','desprice']);
                    } catch (\Throwable $th) {
                       throw new \Exception("Produto de id {$value_} não encontrado");
                    }
                    /**
                     * @param desname
                     * @param desprice
                     * @return array
                    */
                    try {
                        $product->desprice = floatval(str_replace(',', '.', str_replace('.', '', $product->desprice)));
                        $products[] = $product;
                    } catch (\Throwable $th) {
                        throw new \Exception("Erro ao formatar o valor do produto - {$product->id}", 1);
                    }
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
     * @expects {idclient, products}
     * @return \Illuminate\Http\JsonResponse
    */
    public function create(Request $request){
        //@method POST
        $messages = [
            'idclient.required' => 'O campo nome é obrigatório',
            'desproducts.required' => 'O campo preço é obrigatório',
        ];
        /**
         * @var array $rules
         * @var array $messages
         * @expects {idclient, products}
        */
        try {
            $this->validate($request, [
                'idclient' => 'required',
                'desproducts' => 'required',
            ], $messages);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
       //create a new sell
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
