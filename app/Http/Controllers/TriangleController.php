<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Triangulo;

class TrianguloController extends Controller{
    
    /**
     * Create a new controller instance.
     * @return void
    */
    public function __construct(){
        //Instanciando classes que serão utilizadas
        $this->triangulo = new Triangulo();
    }

    /**
     * Endpoint para listagem de triangulos na API
    */
    public function index(){
        $triangulo = $this->triangulo->get_all();
        return response()->json($triangulo, 200);
    }

    /**
     * Endpoint para listagem de informações especificas de um triângulo na API
    */
    public function show($id){
        $triangulo = $this->triangulo->get_triangulo_by_id($id);
        return response()->json($triangulo, 200);
    }

    /**
     * Endpoint para inserção de informações de um triângulo na API
    */
    public function insert(Request $request){
        //Obtendo dados da requisição
        $lado_a = request('lado_a');
        $lado_b = request('lado_b');
        $lado_c = request('lado_c');

        //verifica se algum lado é um valor inválido
        if($lado_a < 0 || $lado_b < 0 || $lado_c < 0){
            return response()->json(array("msg" => "Dados Inválidos. Lados não podem ter valores negativos!"), 422);
        }

        //seta os dados do triângulo
        $this->triangulo->set_lado_a($lado_a);
        $this->triangulo->set_lado_b($lado_b);
        $this->triangulo->set_lado_c($lado_c);
        
        //persiste os dados no BD
        $id = $this->triangulo->save_from_data();

        //retorna dados pra requisição
        return response()->json(array("msg" => "Criado com sucesso!", "id" => $id), 200);
    }

    /**
     * Endpoint para atualização de informações de um triângulo na API
    */
    public function update(Request $request, $id){
        //Obtendo dados da requisição
        $lado_a = request('lado_a');
        $lado_b = request('lado_b');
        $lado_c = request('lado_c');

        //verifica se algum lado é um valor inválido
        if($lado_a < 0 || $lado_b < 0 || $lado_c < 0){
            return response()->json(array("msg" => "Dados Inválidos. Lados não podem ter valores negativos!"), 422);
        }

        //seta os dados do triângulo
        $this->triangulo->set_lado_a($lado_a);
        $this->triangulo->set_lado_b($lado_b);
        $this->triangulo->set_lado_c($lado_c);

        //persiste os dados no BD
        $id = $this->triangulo->save_from_data($id);
        
        //retorna dados pra requisição
        return response()->json(array("msg" => "Atualizado com sucesso!", "id" => $id), 200);
    }

    /**
     * Endpoint para removação de um triângulo na API
    */
    public function delete($id){
        $this->triangulo->delete_data($id);
        return response()->json(array("msg" => "Removido com sucesso"), 200);
    }
}