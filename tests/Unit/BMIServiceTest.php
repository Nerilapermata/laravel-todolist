<?php

namespace Tests\Feature;

use Tests\TestCase;

class BMIServiceTest extends TestCase
{
    /** @test */
    public function it_calculates_bmi_correctly()
    {
        $weight = 70;    // kg
        $height_cm = 170; // cm
        $height_m = $height_cm / 100;
        $expected_bmi = $weight / ($height_m * $height_m);

        $this->assertEqualsWithDelta(24.22, $expected_bmi, 0.01); // BMI = 24.22
    }

    /** @test */
    public function it_returns_correct_bmi_category()
    {
        $this->assertEquals('Kurus', $this->getBMICategory(17));
        $this->assertEquals('Normal', $this->getBMICategory(22));
        $this->assertEquals('Gemuk', $this->getBMICategory(27));
        $this->assertEquals('Obesitas', $this->getBMICategory(32));
    }

    private function getBMICategory($bmi)
    {
        if ($bmi < 18.5) {
            return 'Kurus';
        } elseif ($bmi < 25) {
            return 'Normal';
        } elseif ($bmi < 30) {
            return 'Gemuk';
        } else {
            return 'Obesitas';
        }
    }
}
