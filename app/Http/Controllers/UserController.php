<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
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
         * @return UserModel or Exception {?}
        */
        try{
            $user = UserModel::find($id);
        } catch(\Throwable $th){
            throw new \Exception("Usuário de id {$id} não encontrado");
        }
        /**
         * @var UserModel $user
         * @return {?} Exception
        */
        try {
            $user->delete();
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao deletar o usuário de id {$id}");
        }
        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     * @expects {parameters} - OPTIONAL
     * @return \Illuminate\Http\JsonResponse
    */
    public function list(Request $request){
        //@method GET {MAIN}
        /**
         * @expects $request->all()[0], $_GET[0]
         * @return \Illuminate\Http\JsonResponse
         */
        if(array_key_exists(0, $request->all())){
           $values = [];
           try {
             foreach($request->all() as $key => $value) array_push($values, $value);
             $users = UserModel::get($values);
           } catch (\Throwable $th) {
             throw new \Exception("Erro ao filtrar resultados do cliente", 1);
           }
        }else{
            /**
             * @expects $request->all()
             * @return \Illuminate\Http\JsonResponse
            */
            $users = UserModel::all();
            foreach($users as $user){
                try {
                    //format desdocument to 00030600050 to 000.306.000-50
                    $user->desdocument = substr($user->desdocument, 0, 3) . '.' .
                                         substr($user->desdocument, 3, 3) . '.' .
                                         substr($user->desdocument, 6, 3) . '.' .
                                         substr($user->desdocument, 9, 2);
                    $user->dtbirth_ = date('d/m/Y', strtotime($user->dtbirth));
                } catch (\Throwable $th) {
                   throw new \Exception("Erro ao formatar dados do cliente", 1);
                }
            }
        }
        return response()->json($users);
    }
    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function create(Request $request){
        //@method POST {MAIN}
        $messages = [
            'desname.required' => 'O campo nome é obrigatório',
            'desnumero.required' => 'O campo número é obrigatório',
            'desdocument.required' => 'O campo documento é obrigatório',
            'desemail.required' => 'O campo email é obrigatório',
            'desemail.email' => 'O campo email não é um email válido',
            'desemail.unique' => 'Já tem uma conta com este e-mail cadastrado.',
            'dtbirth.required' => 'O campo data de nascimento é obrigatório',
            'desbairro.required' => 'O campo bairro é obrigatório',
            'descep.required' => 'O campo cep é obrigatório',
            'descidade.required' => 'O campo cidade é obrigatório',
            'descomplemento.required' => 'O campo complemento é obrigatório',
            'deslogradouro.required' => 'O campo logradouro é obrigatório',
        ];
        //validate if $request has all the required fields and send errors in json
        try {
            $this->validate($request, [
                'desname' => 'required',
                'desnumero' => 'required',
                'desemail' => 'required|email',
                'desdocument' => 'required',
                'dtbirth' => 'required',
                'desbairro' => 'required',
                'descep' => 'required',
                'descidade' => 'required',
                'descomplemento' => 'required',
                'deslogradouro' => 'required',
            ], $messages);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
        /**
         * @expects $request->all()
         * @return \Illuminate\Http\JsonResponse
        */
        try {
           //check if desemail and desdocument are unique in database, sometimes $validate doesn't work
           $user = UserModel::where('desemail', $request->desemail)->first();
           if($user){
                return response()->json(['error' => 'Já existe alguém cadastrado com este e-mail'], 500);
           }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao verificar se o e-mail já está cadastrado'], 500);
        }
       //create a new user
       $user = new UserModel();
       $user->desname = $request->desname;
       $user->desnumero = $request->desnumero;
       $user->desdocument = $request->desdocument;
       $user->desemail = $request->desemail;
       $user->dtbirth = date('Y-m-d', strtotime($request->dtbirth));
       $user->desbairro = $request->desbairro;
       $user->descep = $request->descep;
       $user->descidade = $request->descidade;
       $user->descomplemento = $request->descomplemento;
       $user->deslogradouro = $request->deslogradouro;
       try {
         $user->save();
       } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao salvar usuário, verifique se preencheu todos os campos corretamente!'], 500);
       }
        return response()->json(['message' => $user], 201);
    }
}
