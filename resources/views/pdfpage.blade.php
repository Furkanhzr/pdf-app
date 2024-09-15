@extends('layouts.app')

@section('title', 'Anasayfa')

@section('content')
    <style>
        .pdf-section {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .pdf-section h3 {
            color: #007bff;
            font-size: 1.5rem;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
    </style>
    <div class="pdf-section">
        @foreach($items as $item)
            <div class="item">
                <h3>{{ $item->title }}</h3>
                <p>{{ $item->description }}</p>
                <img src="{{ $item->image }}" alt="Image" width="650px" height="400px" style="border-radius: 8px; margin-top: 15px;">
            </div>
        @endforeach
    </div>
@endsection





