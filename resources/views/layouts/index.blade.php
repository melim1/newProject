@extends('layouts.admin')

@section('content')
<style>
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        text-align: center;
    }
    .table th, .table td {
        padding: 0.75rem;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }
    .status-valid {
        color: green;
        font-weight: bold;
    }
    .status-refus {
        color: red;
        font-weight: bold;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

<div class="container">
    <h1>Gérer les Rendez-vous</h1>
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
                        <td class="{{ $rdv->statut === 'validé' ? 'status-valid' : ($rdv->statut === 'refusé' ? 'status-refus' : '') }}">
                            {{ ucfirst($rdv->statut) }}
                        </td>
                        <td>{{ $rdv->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if ($rdv->statut === 'en attente')
                                <form action="{{ route('rdvs.update', $rdv->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="date" name="date_visite" class="form-control mb-2" required min="{{ now()->toDateString() }}">
                                    <input type="time" name="heure_visite" class="form-control mb-2" required>
                                    <select name="statut" class="form-control mb-2" required>
                                        <option value="validé">Validé</option>
                                        <option value="refusé">Refusé</option>
                                    </select>
                                    <button type="submit" class="btn btn-success btn-sm">Valider</button>
                                </form>
                                <form action="{{ route('rdvs.update', $rdv->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="statut" value="refusé">
                                    <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                                </form>
                            @elseif ($rdv->statut === 'refusé')
                                <span class="status-refus">Rendez-vous refusé</span>
                            @else
                                {{ $rdv->date_visite }} à {{ $rdv->heure_visite }}
                            @endif
                        </td>
                        <td>
                            @if ($rdv->statut === 'validé')
                                <span class="status-valid">Rendez-vous validé</span>
                            @elseif ($rdv->statut === 'refusé')
                                <span class="status-refus"> Rendez-vous refusé</span>
                            @else
                                <span>En attente</span>
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