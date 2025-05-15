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
</style>

<div class="form-wrapper">
    <div class="form-container">
        <h2>Modifier le bien immobilier</h2>
        <div class="mb-3 text-end">
            <a class="btn btn-primary btn-sm" href="{{ route('app_profil') }}">
                <i class="fa fa-arrow-left"></i> Retour
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profil.biens.update', $immobilier->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label><strong>Adresse:</strong></label>
                    <input type="text" name="adresse" value="{{ $immobilier->adresse }}" class="form-control" placeholder="Adresse">
                </div>
                <div class="col-md-6 mb-3">
                    <label><strong>Type:</strong></label>
                    <input type="text" name="type" value="{{ $immobilier->type }}" class="form-control" placeholder="Type">
                </div>
                <div class="col-md-6 mb-3">
                    <label><strong>Prix:</strong></label>
                    <input type="number" name="prix" value="{{ $immobilier->prix }}" class="form-control" placeholder="Prix">
                </div>
                <div class="col-md-6 mb-3">
                    <label><strong>Surface:</strong></label>
                    <input type="number" name="surface" value="{{ $immobilier->surface }}" class="form-control" placeholder="Surface">
                </div>
                <div class="col-md-6 mb-3">
                    <label><strong>Image:</strong></label>
                    <input type="file" name="user_image" class="form-control">
                    <img src="{{ asset($immobilier->user_image) }}" width="100px" class="mt-2 rounded" alt="Image actuelle">
                </div>
                <div class="col-12 mb-3">
                    <label><strong>Description:</strong></label>
                    <textarea name="description" class="form-control" placeholder="Description">{{ $immobilier->description }}</textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
