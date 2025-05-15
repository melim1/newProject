@extends('layouts.admin')

@section('content')



<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Immobiliers</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('immobiliers.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Adresse:</strong>
            {{ $immobiliers->adresse }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Type:</strong>
            {{ $immobiliers->type }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Prix:</strong>
            {{ $immobiliers->prix }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Surface:</strong>
            {{ $immobiliers->surface }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ asset($immobiliers->user_image) }}" width="100">
           
        </div>
    </div>
 
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {{ $immobiliers->description }}
        </div>
    </div>
</div>

@endsection
