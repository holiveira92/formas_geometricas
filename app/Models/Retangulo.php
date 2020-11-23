<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Retangulo extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = "retangulo";
    protected $fillable = ['base', 'altura'];
    Protected $primaryKey = "id";
    private $base,$altura;

    /**
     * Seta Base
     */
    public function set_base($base){
        $this->base = $base;
    }

    /**
     * Seta Altura
     */
    public function set_altura($altura){
        $this->altura = $altura;
    }

    /**
     * Obtém atributo Base
     */
    public function get_base(){
        return $this->base;
    }

    /**
     * Obtém atributo Altura
     */
    public function get_altura(){
        return $this->altura;
    }

    /**
     * obtém dados do médico por ID
     */
    public function get_retangulo_by_id($retangulo_id){
        $retangulo = $this->stdClass_to_Array(
            DB::table('retangulo')
                ->select('*')
                ->where('retangulo.id', '=', $retangulo_id)
                ->get()->toArray());
        $retangulo = !empty($retangulo[0]) ? $retangulo[0] : $retangulo;
        return $retangulo;
    }

    /**
     * obtém coleção de dados dos médico cadastrados
     */
    public function get_retangulos(){
        $retangulo = $this->stdClass_to_Array(
                DB::table('retangulo')
                    ->select('*')
                    ->get()->toArray());
        return $retangulo;
    }

    /**
     * Converte um array stdclass para um array associativo
     */
    public function stdClass_to_Array($array){
        $array = array_map(function($result){
            return (array) $result;
        }, $array);
        return $array;
    }

    /**
     * Persistência de dados
     */
    public function save_from_data($id=false){
        $id                             = (!empty($id)) ? $id : false;
        $retangulo                      = $this->find($id);
        if(!empty($retangulo->id)){
            $id                             = $retangulo->id;
            $retangulo->update([
                'base'                      => $this->base,
                'altura'                    => $this->altura,
            ]);
        }else{
            $id = DB::table('retangulo')->insertGetId(array(
                'base'                      => $this->base,
                'altura'                    => $this->altura,
            ));
        }
        return $id;
    }

    /**
     * delete registro do BD
     */
    public function delete_data($retangulo_id){
        $retangulo = $this->find($retangulo_id);
        if(!empty($retangulo->id)){
            $retangulo->delete();
        }
    }

    /**
     * Obtém toda a coleção de dados do BD
     */
    public function get_all(){
        $retangulos = $this->get()->toArray();
        return $retangulos;
    }

    /**
     * Obtém a área total de todos os retangulos cadastrados
     */
    public function get_area_total(){
        //realizando cálculo da área
        $retangulos         = $this->stdClass_to_Array(DB::table($this->table)->select('*')->get()->toArray());
        $area_total         = 0;
        foreach($retangulos as $key=>$retangulo){
            $base           = !empty($retangulo['base']) ? $retangulo['base'] : 0;
            $altura         = !empty($retangulo['altura']) ? $retangulo['altura'] : 0;
            $area           = ( $base * $altura );
            $area_total     = $area_total + $area;
        }
        return number_format($area_total,2);
    }
}
