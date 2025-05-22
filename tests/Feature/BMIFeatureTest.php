<?php

namespace Tests\Feature;

use Tests\TestCase;

class BMIFeatureTest extends TestCase
{
    /** @test */
    public function it_shows_the_bmi_form()
    {
        $response = $this->get('/bmi');
        $response->assertStatus(200);
        $response->assertSee('Kalkulator Indeks Massa Tubuh');
    }

    /** @test */
    public function it_calculates_bmi_and_shows_result()
    {
        $response = $this->post('/bmi', [
            'weight' => 70,
            'height' => 170
        ]);

        $response->assertStatus(200);
        $response->assertSee('Hasil BMI');
        $response->assertSee('Normal'); // karena BMI-nya 24.22
    }

    /** @test */
    public function it_shows_validation_errors_when_data_is_invalid()
    {
        $response = $this->post('/bmi', [
            'weight' => '',
            'height' => ''
        ]);

        $response->assertSessionHasErrors(['weight', 'height']);
    }
}
