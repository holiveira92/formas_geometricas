<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Triangulo extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = "triangulo";
    protected $fillable = ['lado_a', 'lado_b', 'lado_c'];
    Protected $primaryKey = "id";
    private $lado_a,$lado_b,$lado_c;

    /**
     * Seta Lado A
     */
    public function set_lado_a($lado_a){
        $this->lado_a = $lado_a;
    }

    /**
     * Seta Lado B
     */
    public function set_lado_b($lado_b){
        $this->lado_b = $lado_b;
    }

    /**
     * Seta Lado C
     */
    public function set_lado_c($lado_c){
        $this->lado_c = $lado_c;
    }

    /**
     * Obtém atributo Lado A
     */
    public function get_lado_a(){
        return $this->lado_a;
    }

    /**
     * Obtém atributo Lado B
     */
    public function get_lado_b(){
        return $this->lado_b;
    }

    /**
     * Obtém atributo Lado C
     */
    public function get_lado_c(){
        return $this->lado_c;
    }

    /**
     * obtém dados do triangulo por ID
     */
    public function get_triangulo_by_id($triangulo_id){
        $triangulo = $this->stdClass_to_Array(
            DB::table('triangulo')
                ->select('*')
                ->where('triangulo.id', '=', $triangulo_id)
                ->get()->toArray());
        $triangulo = !empty($triangulo[0]) ? $triangulo[0] : $triangulo;
        return $triangulo;
    }

    /**
     * obtém coleção de dados dos triangulo cadastrados
     */
    public function get_triangulos(){
        $triangulo = $this->stdClass_to_Array(
                DB::table('triangulo')
                    ->select('*')
                    ->get()->toArray());
        return $triangulo;
    }

    /**
     * Obtém toda a coleção de dados do BD
     */
    public function get_all(){
        $triangulos = $this->get()->toArray();
        return $triangulos;
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
        $triangulo                      = $this->find($id);
        if(!empty($triangulo->id)){
            $id                             = $triangulo->id;
            $triangulo->update([
                'lado_a'                    => $this->lado_a,
                'lado_b'                    => $this->lado_b,
                'lado_c'                    => $this->lado_c,
            ]);
        }else{
            $id = DB::table('triangulo')->insertGetId(array(
                'lado_a'                    => $this->lado_a,
                'lado_b'                    => $this->lado_b,
                'lado_c'                    => $this->lado_c,
            ));
        }
        return $id;
    }

    /**
     * delete registro do BD
     */
    public function delete_data($triangulo_id){
        $triangulo = $this->find($triangulo_id);
        if(!empty($triangulo->id)){
            $triangulo->delete();
        }
    }

    /**
     * Obtém a área total de todos os triangulos cadastrados
     */
    public function get_area_total(){
        //realizando cálculo da área
        $triangulos     = $this->stdClass_to_Array(DB::table($this->table)->select('*')->get()->toArray());
        $area_total     = 0;
        foreach($triangulos as $key=>$triangulo){
            $a              = !empty($triangulo['lado_a']) ? $triangulo['lado_a'] : 0;
            $b              = !empty($triangulo['lado_b']) ? $triangulo['lado_b'] : 0;
            $c              = !empty($triangulo['lado_c']) ? $triangulo['lado_c'] : 0;
            $semi_perimetro = ($a + $b + $c) / 2;
            $area           = ( $semi_perimetro * ($semi_perimetro - $a)*($semi_perimetro - $b)*($semi_perimetro - $c) );
            $area           = (is_nan(sqrt($area))) ? 0 : sqrt($area);
            $area_total     = $area_total + $area;
        }
        return number_format($area_total,2);
    }
}
