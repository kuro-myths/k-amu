<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .error-wrapper {
            max-width: 600px;
            width: 100%;
            padding: 20px;
        }

        .error-container {
            text-align: center;
            background: white;
            padding: 60px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mascot-image {
            width: 150px;
            height: auto;
            margin: 0 auto 20px;
            animation: shake 0.5s ease infinite;
        }

        @keyframes shake {
            0%, 100% {
                transform: rotate(0deg);
            }
            25% {
                transform: rotate(-3deg);
            }
            75% {
                transform: rotate(3deg);
            }
        }

        .error-code {
            font-size: 100px;
            font-weight: 900;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 10px 0;
            line-height: 1;
        }

        .error-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin: 15px 0;
        }

        .error-message {
            font-size: 16px;
            color: #6b7280;
            margin: 20px 0 35px 0;
            line-height: 1.8;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-back {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3);
        }

        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(245, 87, 108, 0.5);
            color: white;
        }

        .btn-home {
            display: inline-block;
            padding: 12px 30px;
            background: #f3f4f6;
            color: #1f2937;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
            border: 2px solid #e5e7eb;
        }

        .btn-home:hover {
            background: #e5e7eb;
            color: #1f2937;
            transform: translateY(-3px);
            border-color: #f5576c;
        }
    </style>
</head>

<body>
    <div class="error-wrapper">
        <div class="error-container">
            <img src="/avtuber-mascot.svg" alt="Mascot" class="mascot-image">
            <h1 class="error-code">500</h1>
            <h2 class="error-title">Terjadi Kesalahan Server</h2>
            <p class="error-message">
                Maaf, server kami sedang mengalami masalah.<br>
                Tim kami sudah diberitahu dan sedang menanganinya. Coba lagi dalam beberapa saat!
            </p>
            <div class="btn-group">
                <button onclick="goBack()" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </button>
                <a href="{{ route('superadmin.beranda') }}" class="btn-home">
                    <i class="bi bi-house"></i> Ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            if (document.referrer && document.referrer !== '') {
                window.location.href = document.referrer;
            } else {
                window.location.href = "{{ route('superadmin.beranda') }}";
            }
        }
    </script>
</body>

</html>
