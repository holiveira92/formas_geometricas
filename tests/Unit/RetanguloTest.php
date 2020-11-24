<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class RetanguloTest extends TestCase
{   
    /** @test */
    public function check_if_triangle_data_entry_is_valid()
    {   
        $response       = Http::post('http://localhost:8000/api/retangulo/', ['base' => 15,'altura' => -10]);
        $this->assertTrue($response->hasHeader('Location'));
        $this->assertStatus(200);
    }

    /** @test */
    public function check_if_get_data_is_valid()
    {   
        $response = Http::post('/api/retangulo/');
        $response->assertStatus(200);
    }

    /** @test */
    public function check_if_get_data_by_id_is_valid()
    {   
        $id = 2;
        $response = Http::post("/api/retangulo/$id");
        $response->assertStatus(200);
    }

}
