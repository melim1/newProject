@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Immobilier</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm mb-2" href="{{ route('immobiliers.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('immobiliers.update', $immobilier->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>Adresse:</strong>
                    <input type="text" name="adresse" value="{{ $immobilier->adresse }}" class="form-control" placeholder="Adresse">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>Type:</strong>
                    <input type="text" name="type" value="{{ $immobilier->type }}" class="form-control" placeholder="Type">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>Prix:</strong>
                    <input type="number" name="prix" value="{{ $immobilier->prix }}" class="form-control" placeholder="Prix">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>Surface:</strong>
                    <input type="number" name="surface" value="{{ $immobilier->surface }}" class="form-control" placeholder="Surface">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="user_image" class="form-control">
                    <img src="{{ asset($immobilier->user_image) }}" width="100px" alt="Image actuelle">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" placeholder="Description">{{ $immobilier->description }}</textarea>
                </div>
            </div>

            <div class="col-xs-12">
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </div>
    </form>
@endsection
