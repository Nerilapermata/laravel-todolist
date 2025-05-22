<?php

namespace App\Helpers;

class BMIHelper
{
    public static function calculateBMI(float $weight, float $heightCm): array
    {
        $height = $heightCm / 100;

        if ($height <= 0) {
            throw new \InvalidArgumentException("Tinggi tidak boleh nol atau negatif.");
        }

        $bmi = $weight / ($height * $height);
        $bmi = round($bmi, 2);

        if ($bmi < 18.5) {
            $category = 'Kurus';
        } elseif ($bmi < 25) {
            $category = 'Normal';
        } elseif ($bmi < 30) {
            $category = 'Gemuk';
        } else {
            $category = 'Obesitas';
        }

        return [
            'bmi' => $bmi,
            'category' => $category,
        ];
    }
}
