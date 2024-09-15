<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Uygulaması')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ url('pdf-image.png') }}">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e3e4e6;
            color: #333;
            transition: opacity 1s ease-in-out;
        }

        header {
            background-color: #e32e2e;
            color: white;
            padding: 15px 30px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            border-bottom: 4px solid #932323;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
            display: inline-block;
            vertical-align: middle;
        }

        header .pdf-button {
            display: inline-block;
            float: right;
            margin-top: 5px;
        }

        header button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        header button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .content {
            margin-top: 80px;
            padding: 20px;
        }

        .item img {
            display: block;
            margin: 0 auto;
            max-width: 700px; /* Resim genişliği */
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .pagination-wrapper {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .pagination-wrapper .pagination {
            margin-bottom: 0;
        }

        .pagination-wrapper .page-link {
            color: #d33737;
            border: none;
            margin: 0 5px;
        }

        .pagination-wrapper .page-item.active .page-link {
            background-color: #d33737;
            color: white;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .pagination-wrapper .page-link:hover {
            background-color: #e0e0e0;
            border-radius: 50%;
        }

        @media print {
            header,
            .pagination-wrapper {
                display: none;
            }
        }
    </style>
</head>
<body>

@if(!isset($isPdf) || !$isPdf)
    <header>
        <img src="{{asset('pdf-image.png')}}" height="45px" width="45px">
        <h1>PDF Dönüştürücü</h1>
        <div class="pdf-button">
            <form action="{{ route('generate.pdf') }}" method="GET">
                <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">
                <button type="submit">Sayfayı PDF'e Çevir</button>
            </form>
        </div>
    </header>tems->links('pagination::bootstrap-4') }}
@endif

<div class="content">
    <div class="pdf-content">
        @yield('content')
    </div>
</div>


@if(!isset($isPdf) || !$isPdf)
    <div class="pagination-wrapper">
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        let currentPage = parseInt('{{ request()->get('page', 1) }}');

        function goToPage(page) {
            window.location.href = `?page=${page}`;
        }

        $(document).keydown(function(e) { //document.addEventListener('keydown', function(e) {
            if (e.key === "ArrowRight") {
                goToPage(currentPage + 1);
            } else if (e.key === "ArrowLeft") {
                goToPage(currentPage - 1);
            }
        });

        $("body").css("opacity", 0).animate({ opacity: 1 }, 1000);
    });
</script>
</body>
</html>







