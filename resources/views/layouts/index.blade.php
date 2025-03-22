@extends('layouts.admin')

@section('content')
<style>
    /* Ajoutez ceci dans votre section <style> */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .btn-primary {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-primary:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
</style>

<div class="container">
    <h1>Manage Rdvs</h1>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Message</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Date de Création</th>
                        <th>Date et Heure du RDV</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rendezVous as $rdv)
                    <tr>
                        <td>{{ $rdv->nom_complet }}</td>
                        <td>{{ $rdv->email }}</td>
                        <td>{{ $rdv->telephone }}</td>
                        <td>{{ $rdv->message }}</td>
                        <td>{{ $rdv->type }}</td>
                        <td>{{ $rdv->statut }}</td>
                        <td>{{ $rdv->created_at->format('d/m/Y H:i') }}</td>
                        <td>
    @if ($rdv->statut === 'en attente')
        <!-- Formulaire pour choisir la date et l'heure -->
        <form action="{{ route('rdvs.update', $rdv->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="date" name="date_visite" class="form-control mb-2" required>
            <input type="time" name="heure_visite" class="form-control mb-2" required>
            <select name="statut" class="form-control mb-2" required>
                <option value="validé">Validé</option>
                <option value="refusé">Refusé</option>
            </select>
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-check"></i> Valider
            </button>
        </form>

        <!-- Bouton pour refuser directement -->
        <form action="{{ route('rdvs.update', $rdv->id) }}" method="POST" class="mt-2">
            @csrf
            @method('PUT')
            <input type="hidden" name="statut" value="refusé">
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-times"></i> Refuser
            </button>
        </form>

    @elseif ($rdv->statut === 'refusé')
        <!-- Afficher un message si le rendez-vous est refusé -->
        <span class="text-danger">Rendez-vous refusé</span>

    @else
        <!-- Afficher la date et l'heure si le statut n'est pas "en attente" ou "refusé" -->
        {{ $rdv->date_visite }} à {{ $rdv->heure_visite }}
    @endif
</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rendezVous->links() }}
        </div>
    </div>
</div>
@endsection   