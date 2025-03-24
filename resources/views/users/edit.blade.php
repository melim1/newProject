@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gray-600 text-white" style="background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-user-edit me-2"></i>Modifier le profil
                        </h4>
                        <a href="{{ route('users.index') }}" class="btn btn-light btn-sm shadow-sm">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                            <h5 class="alert-heading fw-bold">
                                <i class="fas fa-exclamation-triangle me-1"></i> Erreur de validation
                            </h5>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user->id) }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-4 p-3 bg-light rounded-3">
                            <h5 class="text-gray-700 mb-3 fw-bold">
                                <i class="fas fa-id-card me-2"></i>Informations personnelles
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-medium">Nom complet</label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white"><i class="fas fa-user text-gray-600"></i></span>
                                        <input type="text" class="form-control border-start-0" id="name" name="name" 
                                               value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-medium">Email</label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white"><i class="fas fa-envelope text-gray-600"></i></span>
                                        <input type="email" class="form-control border-start-0" id="email" name="email" 
                                               value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded-3">
                            <h5 class="text-gray-700 mb-3 fw-bold">
                                <i class="fas fa-lock me-2"></i>Sécurité
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-medium">Nouveau mot de passe</label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white"><i class="fas fa-key text-gray-600"></i></span>
                                        <input type="password" class="form-control border-start-0" id="password" name="password">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                        </button>
                                    </div>
                                    <small class="text-muted">Laissez vide pour ne pas changer</small>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="confirm-password" class="form-label fw-medium">Confirmer le mot de passe</label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white"><i class="fas fa-key text-gray-600"></i></span>
                                        <input type="password" class="form-control border-start-0" id="confirm-password" name="confirm-password">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->hasRole('Admin'))
                        <div class="mb-4 p-3 bg-light rounded-3">
                            <h5 class="text-gray-700 mb-3 fw-bold">
                                <i class="fas fa-user-shield me-2"></i>Rôles et permissions
                            </h5>
                            
                            <div class="mb-3">
                                <label class="form-label fw-medium">Rôles</label>
                                <select name="roles[]" class="form-select select2 shadow-sm" multiple="multiple" style="width: 100%;">
                                    @foreach ($roles as $value => $label)
                                        <option value="{{ $value }}" {{ in_array($value, $userRole) ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="submit" class="btn btn-gray-700 text-white px-4 py-2 shadow-sm fw-medium" style="background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%)"
               >
                                <i class="fas fa-save me-1"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        @if($user->id === auth()->id())
        <div class="col-md-4">
            <div class="card shadow-lg border-0 mt-4">
                <div class="card-header bg-gray-600 text-white" style="background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%);">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle me-2"></i>Informations supplémentaires
                    </h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <span class="fw-medium"><i class="fas fa-calendar-alt me-2 text-gray-600"></i>Créé le</span>
                            <span class="text-gray-700 mb-3 ">{{ $user->created_at->format('d/m/Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <span class="fw-medium"><i class="fas fa-sync-alt me-2 text-gray-600"></i>Mis à jour le</span>
                            <span class="text-gray-700 mb-3 ">{{ $user->updated_at->format('d/m/Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <span class="fw-medium"><i class="fas fa-user-tag me-2 text-gray-600"></i>Rôle principal</span>
                            <span class="text-gray-700 mb-3 ">{{ $user->roles->first()->name ?? 'Aucun' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            
            
        </div>
        @endif
    </div>
</div>

@section('scripts')
<script>
    // Activer les tooltips
    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Toggle password visibility
        $('.toggle-password').click(function(){
            const input = $(this).parent().find('input');
            const icon = $(this).find('i');
            
            if(input.attr('type') === 'password'){
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Sélectionnez un rôle",
            allowClear: true,
            theme: "bootstrap-5"
        });
    });
</script>
@endsection

@endsection