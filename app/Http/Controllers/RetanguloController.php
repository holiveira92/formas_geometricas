<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Retangulo;

class RetanguloController extends Controller{
    
    /**
     * Create a new controller instance.
     * @return void
    */
    public function __construct(){
        //Instanciando classes que serão utilizadas
        $this->retangulo = new Retangulo();
    }

    /**
     * Endpoint para listagem de retangulos na API
    */
    public function index(){
        $retangulo = $this->retangulo->get_all();
        return response()->json($retangulo, 200);
    }

    /**
     * Endpoint para listagem de informações especificas de um retangulo na API
    */
    public function show($id){
        $retangulo = $this->retangulo->get_retangulo_by_id($id);
        return response()->json($retangulo, 200);
    }

    /**
     * Endpoint para inserção de informações de um retangulo na API
    */
    public function insert(Request $request){
        //Obtendo dados da requisição
        $base = request('base');
        $altura = request('altura');

        //verifica se algum lado é um valor inválido
        if($base < 0 || $altura < 0){
            return response()->json(array("msg" => "Dados Inválidos. Lados não podem ter valores negativos!"), 422);
        }

        //seta os dados do retangulo
        $this->retangulo->set_base($base);
        $this->retangulo->set_altura($altura);
        
        //persiste os dados no BD
        $id = $this->retangulo->save_from_data();

        //retorna dados pra requisição
        return response()->json(array("msg" => "Criado com sucesso!", "id" => $id), 200);
    }

    /**
     * Endpoint para atualização de informações de um retangulo na API
    */
    public function update(Request $request, $id){
        //Obtendo dados da requisição
        $base = request('base');
        $altura = request('altura');

        //verifica se algum lado é um valor inválido
        if($base < 0 || $altura < 0){
            return response()->json(array("msg" => "Dados Inválidos. Lados não podem ter valores negativos!"), 422);
        }

        //seta os dados do retangulo
        $this->retangulo->set_base($base);
        $this->retangulo->set_altura($altura);

        //persiste os dados no BD
        $id = $this->retangulo->save_from_data($id);
        
        //retorna dados pra requisição
        return response()->json(array("msg" => "Atualizado com sucesso!", "id" => $id), 200);
    }

    /**
     * Endpoint para remoção de um retangulo na API
    */
    public function delete($id){
        $this->retangulo->delete_data($id);
        return response()->json(array("msg" => "Removido com sucesso"), 200);
    }
}