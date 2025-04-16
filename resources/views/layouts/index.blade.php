@extends('layouts.admin')

@section('content')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: none;
    }
    
    .card-header {
        background-color:rgb(72, 74, 78);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 1.25rem 1.5rem;
    }
    
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }
    
    .table th {
        background-color: #f8f9fc;
        color: #5a5c69;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #e3e6f0;
        color: #5a5c69;
    }
    
    .table tr:hover td {
        background-color: #f6f9ff;
    }
    
    .status-valid {
        color: #1cc88a;
        font-weight: bold;
        background-color: rgba(28, 200, 138, 0.1);
        padding: 0.35rem 0.5rem;
        border-radius: 50px;
        display: inline-block;
    }
    
    .status-refus {
        color: #e74a3b;
        font-weight: bold;
        background-color: rgba(231, 74, 59, 0.1);
        padding: 0.35rem 0.5rem;
        border-radius: 50px;
        display: inline-block;
    }
    
    .status-attente {
        color: #f6c23e;
        font-weight: bold;
        background-color: rgba(246, 194, 62, 0.1);
        padding: 0.35rem 0.5rem;
        border-radius: 50px;
        display: inline-block;
    }
    
    .btn-success {
        background-color: #1cc88a;
        border-color: #1cc88a;
        border-radius: 50px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    
    .btn-danger {
        background-color: #e74a3b;
        border-color: #e74a3b;
        border-radius: 50px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    
    .btn-success:hover, .btn-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .form-control {
        border-radius: 50px;
        padding: 0.375rem 0.75rem;
        border: 1px solid #d1d3e2;
    }
    
    .form-control:focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .pagination {
        justify-content: center;
        margin-top: 1.5rem;
    }
    
    .page-item.active .page-link {
        background-color:rgb(93, 93, 95);
        border-color: #4e73df;
    }
    
    .page-link {
        color: #4e73df;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .message-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .message-cell:hover {
        white-space: normal;
        overflow: visible;
        position: absolute;
        z-index: 100;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        padding: 1rem;
        border-radius: 5px;
        max-width: 300px;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Gestion des Rendez-vous</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <td class="message-cell" title="{{ $rdv->message }}">{{ $rdv->message }}</td>
                            <td>{{ $rdv->type }}</td>
                            <td>
                                @if($rdv->statut === 'validé')
                                    <span class="status-valid">{{ ucfirst($rdv->statut) }}</span>
                                @elseif($rdv->statut === 'refusé')
                                    <span class="status-refus">{{ ucfirst($rdv->statut) }}</span>
                                @else
                                    <span class="status-attente">{{ ucfirst($rdv->statut) }}</span>
                                @endif
                            </td>
                            <td>{{ $rdv->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($rdv->statut === 'en attente')
                                    <form action="{{ route('rdvs.update', $rdv->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-2">
                                            <input type="date" name="date_visite" class="form-control" required min="{{ now()->toDateString() }}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <input type="time" name="heure_visite" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <select name="statut" class="form-control" required>
                                                <option value="validé">Validé</option>
                                                <option value="refusé">Refusé</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">Confirmer</button>
                                    </form>
                                @elseif ($rdv->statut === 'refusé')
                                    <span class="status-refus">Refusé</span>
                                @else
                                    {{ $rdv->date_visite }} à {{ $rdv->heure_visite }}
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if ($rdv->statut === 'validé')
                                        <span class="status-valid">Confirmé</span>
                                    @elseif ($rdv->statut === 'refusé')
                                        <span class="status-refus">Refusé</span>
                                    @else
                                        <form action="{{ route('rdvs.update', $rdv->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="statut" value="refusé">
                                            <button type="submit" class="btn btn-danger btn-block">Refuser</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $rendezVous->links() }}
            </div>
        </div>
    </div>
</div>
@endsection