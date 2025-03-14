@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
            <!-- Statistiques des utilisateurs -->
            <div class="col-md-4 mb-4">
            <div class="card text-white bg-utilisateur h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total Utilisateurs</h5>
                    <p class="card-text display-4">{{ $totalUsers ?? 0 }}</p>
                </div>
            </div>
        </div>
        <!-- Statistique des biens immobiliers -->
        <div class="col-md-4 mb-4">
            <div class="card text-white  bg-immobilier  h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-building"></i> Total Biens Immobiliers</h5>
                    <p class="card-text display-4">{{ $totalImmobiliers ?? 0 }}</p>
                </div>
            </div>
        </div>

    
    </div>

    <!-- Graphique -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Graphique des utilisateurs et des biens immobiliers</div>
                <div class="card-body">
                    <canvas id="statsChart" width="400" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour initialiser le graphique -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('statsChart').getContext('2d');
        const statsChart = new Chart(ctx, {
            type: 'bar', // Type de graphique (bar, line, pie, etc.)
            data: {
                labels: ['Utilisateurs', 'Biens Immobiliers'], // Étiquettes des données
                datasets: [{
                    label: 'Nombre total',
                    data: [{{ $totalUsers ?? 0 }}, {{ $totalImmobiliers ?? 0 }}], // Données dynamiques
                    backgroundColor: [
                       ' rgba(122, 122, 122, 0.64)', // Couleur pour "Utilisateurs"
                        ' rgba(46, 45, 48, 0.2)', // Couleur pour "Biens Immobiliers"
                    ],
                    borderColor: [
                       ' rgba(46, 45, 48, 0.2)',
                        'rgba(126, 75, 192, 0.2)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection