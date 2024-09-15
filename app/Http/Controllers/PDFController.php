<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class PDFController extends Controller
{

    public function index()
    {
        $items = Item::paginate(1);

        return view('pdfpage', compact('items'));
    }

    public function generatePdf(Request $request)
    {
        // Get the current page from the request
        $currentPage = $request->get('page', 1);

        // Fetch the items for the specific page
        $items = Item::paginate(1, ['*'], 'page', $currentPage);

        // Render the view for the PDF with the CSS for hiding pagination
        $html = View::make('pdfpage', compact('items'))
            ->with('isPdf', true) // Optional flag for debugging
            ->render();


        // DOMDocument kullanarak HTML içeriğini işleyin
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        // Sadece .content sınıfına sahip elemanı seç
        $xpath = new \DOMXPath($dom);
        $contentNode = $xpath->query("//*[contains(@class, 'content')]")->item(0);

        if ($contentNode) {
            // İçeriği al ve PDF'e dönüştür
            $contentHTML = $dom->saveHTML($contentNode);
            $pdf = Pdf::loadHTML($contentHTML);

            // PDF'i tarayıcıda görüntüle
            return $pdf->stream('document.pdf');
        }

        // Eğer .content sınıfı bulunamazsa, varsayılan davranış olarak tüm sayfayı PDF'e çevir
        $pdf = Pdf::loadHTML($html);
        return $pdf->stream('document.pdf');
    }



}
