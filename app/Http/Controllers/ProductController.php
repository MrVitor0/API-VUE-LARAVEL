<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function delete(Request $request){
        $id = $request->id;
        /**
         * @param id
         * @return ProductModel
        */
        try {
            $product = ProductModel::find($id);
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
            throw new \Exception("Erro ao deletar o produto de id {$id}");
        }
        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function list(Request $request){
        //list all products but format dt_birth to dd/mm/yyyy
        if(array_key_exists(0, $request->all())){
            $values = [];
            foreach($request->all() as $key => $value) array_push($values, $value);
            $products = ProductModel::get($values);
         }else{
             //list all users but format dt_birth to dd/mm/yyyy
             $products = ProductModel::all();
             foreach($products as $product){
                /**
                 * @param STRING desprice 
                 * @return {?} Exception
                */
                try {
                    //money will be in format 1,529.00 or 15,00, format to float and sum 1529.00 or 1500.00
                    $product->desprice = floatval(str_replace(',', '.', str_replace('.', '', $product->desprice)));
                    //now number format to brl
                    $product->desprice = number_format($product->desprice, 2, ',', '.');
                } catch (\Throwable $th) {
                    throw new \Exception("Erro ao formatar o preço do produto de id {$product->id}");
                }
             }
         }
        return response()->json($products);
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
            'desname.required' => 'O campo nome é obrigatório',
            'desprice.required' => 'O campo preço é obrigatório',
        ];
        //validate if $request has all the required fields and send errors in json
        try {
            $this->validate($request, [
                'desname' => 'required',
                'desprice' => 'required',
            ], $messages);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
        /**
         * @param STRING desprice
         * @return {?} Exception
        */
        try {
            //check if desname is unique in database, sometimes $validate doesn't work
            $product = ProductModel::where('desname', $request->desname)->first();
            if($product){
                return response()->json(['error' => 'Já existe um produto cadastrado com este nome!'], 500);
            }
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao verificar se o produto de nome {$request->desname} já existe");
        }
       //create a new product
       $product = new ProductModel();
       $product->desname = $request->desname;
       $product->desprice = $request->desprice;
       try {
         $product->save();
       }catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao salvar este produto, verifique se preencheu todos os campos corretamente!'], 500);
       }
        return response()->json(['message' => $product], 201);
    }
}
