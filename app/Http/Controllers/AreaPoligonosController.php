<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Triangulo;
use App\Models\Retangulo;

class AreaPoligonosController extends Controller{
    
    /**
     * Create a new controller instance.
     * @return void
    */
    public function __construct(){
        //Instanciando classes que serão utilizadas
        $this->triangulo = new Triangulo();
        $this->retangulo = new Retangulo();
    }

    /**
     * Endpoint para listagem de totalizador das áreas dos polígonos
    */
    public function index(){
        $area_triangulo = $this->triangulo->get_area_total();
        $area_retangulo = $this->retangulo->get_area_total();
        $total_areas    = array(
            'total_areas_triangulos'    => $area_triangulo,
            'total_areas_retangulos'    => $area_retangulo,
            'total_areas_poligonos'     => number_format($area_triangulo + $area_retangulo,2),
        );
        return response()->json($total_areas, 200);
    }

}