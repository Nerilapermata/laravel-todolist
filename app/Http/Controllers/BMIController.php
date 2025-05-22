<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BMIController extends Controller
{
    public function index()
    {
        return view('bmi');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
        ]);

        $weight = $request->input('weight');
        $height_cm = $request->input('height'); // tinggi asli dalam cm
        $height_m = $height_cm / 100;           // tinggi dalam meter

        $bmi = $weight / ($height_m * $height_m);

        if ($bmi < 18.5) {
            $category = 'Kurus';
        } elseif ($bmi < 25) {
            $category = 'Normal';
        } elseif ($bmi < 30) {
            $category = 'Gemuk';
        } else {
            $category = 'Obesitas';
        }

        return view('bmi', [
            'bmi' => $bmi,
            'category' => $category,
            'weight' => $weight,     // untuk isi ulang input berat
            'height' => $height_cm   // untuk isi ulang input tinggi asli cm
        ]);
    }
}
