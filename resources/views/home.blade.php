    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDF Dönüştürücü</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                max-width: 600px;
                width: 100%;
            }
            h1 {
                margin-top: 0;
                color: #333;
            }
            textarea {
                width: calc(100% - 20px);
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
                resize: vertical;
            }
            button {
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 4px;
                padding: 10px 15px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1>PDF Dönüştürücü</h1>
        <form id="pdf-form" action="{{route('generate.pdf')}}" method="POST">
            @csrf
            <div>
                <textarea name="html" placeholder="HTML kodlarını giriniz" rows="10"></textarea>
            </div>
            <div style="margin-top: 10px;">
                <textarea name="css" placeholder="CSS kodlarını giriniz" rows="10"></textarea>
            </div>
            <button type="submit" style="margin-top: 10px;" formtarget="_blank">PDF Dönüştür</button>
        </form>
    </div>
    </body>
    </html>
