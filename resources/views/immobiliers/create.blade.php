@extends('layouts.admin')

@section('content')
<style>
    .card {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
        overflow: hidden;
        background-color: #ffffff;
    }
    
    .card-header {
        background-color: #2d3748;
        color: #f7fafc;
        border-radius: 8px 8px 0 0 !important;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .card-header h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        color: #f7fafc;
    }
    
    .btn-back {
        background-color: #f7fafc;
        color: #2d3748;
        border: 1px solid #2d3748;
        border-radius: 6px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background-color: #e2e8f0;
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        color: #2d3748;
    }
    
    .btn-submit {
        background-color: #4a5568;
        color: white;
        border-radius: 6px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        letter-spacing: 0.5px;
    }
    
    .btn-submit:hover {
        background-color: #2d3748;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    }
    
    .form-group label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .form-control {
        border-radius: 6px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s;
        background-color: #f8fafc;
    }
    
    .form-control:focus {
        border-color: #cbd5e0;
        box-shadow: 0 0 0 0.2rem rgba(74, 85, 104, 0.15);
        background-color: #ffffff;
    }
    
    .alert-danger {
        border-radius: 6px;
        background-color: rgba(229, 62, 62, 0.1);
        border: 1px solid #e53e3e;
        color: #e53e3e;
    }
    
    .form-section {
        padding: 1.75rem;
        background-color: #f8fafc;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid #edf2f7;
    }
    
    .form-section-title {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
        font-size: 1.1rem;
    }
    
    .file-upload-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }
    
    .file-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2.5rem;
        border: 2px dashed #cbd5e0;
        border-radius: 8px;
        background-color: #ffffff;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .file-upload-label:hover {
        border-color: #a0aec0;
        background-color: #f7fafc;
    }
    
    .file-upload-icon {
        font-size: 2.5rem;
        color: #718096;
        margin-bottom: 1.25rem;
    }
    
    .file-upload-text {
        color: #4a5568;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .file-upload-info {
        color: #718096;
        font-size: 0.875rem;
        margin-top: 0.75rem;
    }
    
    .card-body {
        background-color: #ffffff;
        padding: 2rem;
    }
    
    textarea.form-control {
        min-height: 120px;
    }
</style>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2>Ajouter un nouveau bien immobilier</h2>
            <a href="{{ route('immobiliers.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
        </div>
        
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <strong>Erreur !</strong> Veuillez corriger les problèmes suivants :<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('immobiliers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-section">
                    <h4 class="form-section-title">Informations de base</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Adresse</label>
                                <input type="text" name="adresse" class="form-control"  required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type de bien</label>
                                <input type="text" name="type" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prix (€)</label>
                                <input type="text" name="prix" class="form-control"  required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Surface (m²)</label>
                                <input type="text" name="surface" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4 class="form-section-title">Détails supplémentaires</h4>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Décrivez le bien immobilier..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4 class="form-section-title">Image du bien</h4>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="file-upload-wrapper">
                                <input type="file" name="user_image" id="user_image" class="d-none" required>
                                <label for="user_image" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <span class="file-upload-text">Cliquez pour télécharger une image</span>
                                    <span class="file-upload-info">Formats acceptés : JPG, PNG (Max 5MB)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save mr-2"></i>Enregistrer le bien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Afficher le nom du fichier sélectionné
    document.getElementById('user_image').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Aucun fichier sélectionné';
        document.querySelector('.file-upload-text').textContent = fileName;
    });
</script>
@endsection