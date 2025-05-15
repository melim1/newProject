@extends('layouts.a')

@section('content')
<style>
    /* Arrière-plan de la page avec image */
    body {
        background: url('/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .form-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.95);
        width: 100%;
        max-width: 850px;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 1rem;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .btn-success {
        padding: 10px 30px;
    }

    .file-upload-wrapper {
        text-align: center;
        padding: 20px;
        border: 2px dashed #ccc;
        border-radius: 8px;
    }

    .file-upload-label {
        display: block;
        cursor: pointer;
        font-size: 1.2rem;
        color: #007bff;
    }

    .file-upload-info {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endsection
