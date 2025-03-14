@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- En-tête 
        <div class="row mb-4 border-bottom pb-3">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="display-6 fw-bold">Users Management</h2>
                    <a class="btn btn-success btn-lg" href="{{ route('users.create') }}">
                        <i class="fa fa-plus"></i> Create New User
                    </a>
                </div>
            </div>
        </div>-->

        <!-- Message de succès -->

        <!-- Grille de cartes -->
        <div class="row">
            @foreach ($data as $key => $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-lg border-0 hover-shadow">
                        <div class="card-body">
                            <!-- Nom de l'utilisateur -->
                            <h5 class="card-title fw-bold">{{ $user->name }}</h5>

                            <!-- Email de l'utilisateur -->
                            <p class="card-text">
                                <strong>Contact :</strong>
                                @if($user->email)
                                    {{ $user->email }}
                                @elseif($user->phone)
                                    {{ $user->phone }}
                                @else
                                    <span class="text-muted">No contact information</span>
                                @endif
                            </p>

                            <!-- Rôles de l'utilisateur 
                                <p class="card-text">
                                    <strong>Roles :</strong>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <span class="badge bg-success me-1">{{ $v }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-secondary">No roles assigned</span>
                                    @endif
                                </p>-->

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between mt-3">
                                <!-- Bouton Show
                                    <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}">
                                        <i class="fa-solid fa-list"></i> Show
                                    </a> -->

                                <!-- Bouton Edit
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                   </a> -->

                                <!-- Bouton Delete -->
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this user?');">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {!! $data->links('pagination::bootstrap-5') !!}
        </div>


    </div>

    <!-- Styles supplémentaires -->
    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .alert {
            margin-bottom: 2rem;
        }
    </style>
@endsection