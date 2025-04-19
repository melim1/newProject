@extends('layouts.admin')

@section('content')
<style>
    .notification-title {
        font-size: 2rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 30px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .card-header {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .table th {
        background-color: #f8f9fa;
        text-align: center;
    }

    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-custom {
        background-color: #17a2b8;
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: #138496;
    }

    img.rounded-shadow {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
</style>

<div class="container-fluid">
    <h2 class="text-center notification-title">Mes Notifications</h2>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Notifications reçues
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>ID Immobilier</th>
                            <th>Photo</th>
                            <th>Type</th>
                            <th>Lien</th>
                            <th>Lire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->data['message'] ?? 'Message non disponible' }}</td>
                                <td>{{ $notification->created_at ? $notification->created_at->format('d/m/Y H:i') : 'Date non dispo' }}</td>
                                <td>{{ $notification->data['nom_complet'] ?? 'Nom inconnu' }}</td>
                                <td>{{ $notification->data['email'] ?? 'Email inconnu' }}</td>
                                <td>{{ $notification->data['immobilier_id'] ?? 'ID inconnu' }}</td>
                                <td>
                                    @if(isset($notification->data['immobilier_photo']))
                                        <img src="{{ asset($notification->data['immobilier_photo']) }}" alt="Photo" width="70" class="rounded-shadow">
                                    @else
                                        <span class="text-muted">Aucune photo</span>
                                    @endif
                                </td>
                                <td>{{ $notification->data['type'] ?? 'Type non disponible' }}</td>
                                <td>
                                    <a href="{{ route('rdvs.index') }}" class="btn btn-custom btn-sm">
                                        Voir RDV
                                    </a>
                                </td>



                                <td>
    @if (is_null($notification->read_at))
    <form action="{{ route('notification.markAsRead', $notification->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <button class="btn btn-success btn-sm">Lire</button>
</form>

    @else
        <span class="text-muted">Lue</span>
    @endif
</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
