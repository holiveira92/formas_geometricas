<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class TrianguloTest extends TestCase
{   
    /** @test */
    public function check_if_triangle_data_entry_is_valid()
    {   
        $data           = json_encode(array("lado_a" => 3, "lado_b" => 3, "lado_c" => -3));
        $response       = Http::post('http://localhost:8000/api/triangulo/', [
            'lado_a' => 15,
            'lado_b' => 13,
            'lado_c' => -3
        ]);
        $this->assertTrue($response->hasHeader('Location'));
        $this->assertStatus(200);
    }

    /** @test */
    public function check_if_get_data_is_valid()
    {   
        $response = Http::post('/api/triangulo/');
        $response->assertStatus(200);
    }

    /** @test */
    public function check_if_get_data_by_id_is_valid()
    {   
        $id = 2;
        $response = Http::post("/api/triangulo/$id");
        $response->assertStatus(200);
    }

}
