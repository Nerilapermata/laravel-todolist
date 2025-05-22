<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator BMI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .result {
            margin-top: 30px;
            background-color: #e7f3fe;
            padding: 20px;
            border-left: 5px solid #2196F3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kalkulator Indeks Massa Tubuh (BMI)</h2>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/bmi" method="POST" onsubmit="return validateForm()">
            @csrf
            <label for="weight">Berat Badan (kg):</label>
            <input type="number" step="0.1" name="weight" id="weight" required min="0"
                   value="{{ old('weight', $weight ?? '') }}">

            <label for="height">Tinggi Badan (cm):</label>
            <input type="number" step="1" name="height" id="height" required min="0"
                   value="{{ old('height', $height ?? '') }}">

            <button type="submit">Hitung BMI</button>
        </form>

        @if (isset($bmi))
            <div class="result">
                <p><strong>Hasil BMI:</strong> {{ number_format($bmi, 2) }}</p>
                <p><strong>Kategori:</strong> {{ $category }}</p>
            </div>
        @endif
    </div>

    <script>
        // Cegah input karakter minus (-) dan plus (+) pada semua input number
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('keypress', function (e) {
                if (e.key === '-' || e.key === '+') {
                    e.preventDefault();
                }
            });
        });

        // Validasi tambahan untuk tinggi agar tetap bulat positif
        function validateForm() {
            const heightInput = document.getElementById('height');
            const heightValue = heightInput.value;

            // Cek apakah height adalah bilangan bulat positif
            if (!/^\d+$/.test(heightValue) || parseInt(heightValue) <= 0) {
                alert('Tinggi badan harus berupa bilangan bulat positif.');
                heightInput.focus();
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
