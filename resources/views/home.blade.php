@extends('layouts.admin')

@section('content')
<style>
    :root {
        --primary-color: #5a67d8;
        --secondary-color: #4c51bf;
        --dark-color: #2d3748;
        --light-color: #f8f9fa;
        --success-color: #38a169;
        --danger-color: #e53e3e;
        --warning-color: #dd6b20;
        --info-color: #3182ce;
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .stat-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--card-shadow);
        height: 100%;
        position: relative;
        color: white;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        backdrop-filter: blur(10px);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        z-index: 0;
    }
    
    .stat-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: var(--card-shadow-hover);
    }
    
    .stat-card .card-body {
        padding: 2rem;
        position: relative;
        z-index: 2;
    }
    
    .stat-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        letter-spacing: 0.5px;
    }
    
    .stat-card .card-title i {
        font-size: 1.75rem;
        margin-right: 15px;
        opacity: 0.9;
    }
    
    .stat-card .card-text {
        font-size: 2.75rem;
        font-weight: 800;
        margin-bottom: 0;
        font-family: 'Inter', sans-serif;
    }
    
    .stat-card .card-footer {
        background: rgba(255,255,255,0.1);
        border-top: none;
        padding: 0.75rem 2rem;
        font-size: 0.85rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .bg-utilisateur {
        background: linear-gradient(135deg, var(--info-color), #2b6cb0) !important;
    }
    
    .bg-immobilier {
        background: linear-gradient(135deg, var(--dark-color), #1a202c) !important;
    }
    
    .bg-rendezvous {
        background: linear-gradient(135deg, var(--success-color), #2f855a) !important;
    }
    
    .progress {
        height: 8px;
        background-color: rgba(255,255,255,0.2);
        border-radius: 4px;
        margin-top: 1.5rem;
    }
    
    .progress-bar {
        background-color: white;
        border-radius: 4px;
    }
    
    .chart-card {
        border: none;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        background-color: white;
        overflow: hidden;
    }
    
    .chart-card:hover {
        box-shadow: var(--card-shadow-hover);
    }
    
    .chart-card .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem 2rem;
        font-weight: 700;
        color: var(--dark-color);
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        letter-spacing: 0.5px;
    }
    
    .chart-card .card-header i {
        margin-right: 12px;
        color: var(--primary-color);
        font-size: 1.5rem;
    }
    
    .chart-card .card-body {
        padding: 2rem;
    }
    
    .dashboard-container {
        padding: 2rem 1.5rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--dark-color);
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 12px;
        color: var(--primary-color);
    }
    
    .chart-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .stat-card .card-text {
            font-size: 2.25rem;
        }
        
        .stat-card .card-body {
            padding: 1.5rem;
        }
        
        .chart-card .card-body {
            padding: 1.5rem;
        }
        
        .chart-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Section des statistiques -->
    <h3 class="section-title">
        <i class="fas fa-tachometer-alt"></i> Tableau de bord
    </h3>
    
    <div class="row">
        <!-- Carte Utilisateurs -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card bg-utilisateur">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-users"></i> Total Utilisateurs
                    </h5>
                    <p class="card-text">{{ $totalUsers ?? 0 }}</p>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $totalUsers > 0 ? 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <span><i class="fas fa-sync-alt mr-1"></i> Mis à jour à l'instant</span>
                    <span><i class="fas fa-arrow-up mr-1"></i> 12%</span>
                </div>
            </div>
        </div>
        
        <!-- Carte Immobilier -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card bg-immobilier">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-building"></i> Total Biens Immobiliers
                    </h5>
                    <p class="card-text">{{ $totalImmobiliers ?? 0 }}</p>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $totalImmobiliers > 0 ? 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <span><i class="fas fa-sync-alt mr-1"></i> Mis à jour à l'instant</span>
                    <span><i class="fas fa-arrow-up mr-1"></i> 8%</span>
                </div>
            </div>
        </div>
        
        <!-- Carte Rendez-vous -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card bg-rendezvous">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-calendar-check"></i> Rendez-vous
                    </h5>
                    <p class="card-text">{{ $totalrndv ?? 0 }}</p>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $totalrndv > 0 ? 100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <span><i class="fas fa-sync-alt mr-1"></i> Mis à jour à l'instant</span>
                    <span><i class="fas fa-arrow-up mr-1"></i> 24%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section des graphiques -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h3 class="section-title mb-4">
                <i class="fas fa-chart-area"></i> Visualisation des données
            </h3>
            
            <div class="chart-grid">
                <!-- Graphique à barres -->
                <div class="chart-card">
                    <div class="card-header">
                        <i class="fas fa-chart-bar"></i> Statistiques globales (Barres)
                    </div>
                    <div class="card-body">
                        <canvas id="barChart" height="250"></canvas>
                    </div>
                </div>
                
                <!-- Graphique en courbes -->
                <div class="chart-card">
                    <div class="card-header">
                        <i class="fas fa-chart-line"></i> Évolution (Courbes)
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Données communes pour les deux graphiques
        const labels = ['Utilisateurs', 'Biens Immobiliers', 'Rendez-vous'];
        const dataValues = [{{ $totalUsers ?? 0 }}, {{ $totalImmobiliers ?? 0 }}, {{ $totalrndv ?? 0 }}];
        const backgroundColors = [
            'rgba(49, 130, 206, 0.8)',
            'rgba(45, 55, 72, 0.8)',
            'rgba(56, 161, 105, 0.8)'
        ];
        const borderColors = [
            'rgba(49, 130, 206, 1)',
            'rgba(45, 55, 72, 1)',
            'rgba(56, 161, 105, 1)'
        ];

        // Graphique à barres
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre total',
                    data: dataValues,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1,
                    borderRadius: 12,
                    hoverBackgroundColor: borderColors,
                    barPercentage: 0.6,
                }]
            },
            options: getChartOptions('bar')
        });

        // Graphique en courbes
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Valeurs',
                    data: dataValues,
                    backgroundColor: 'rgba(90, 103, 216, 0.1)',
                    borderColor: 'rgba(90, 103, 216, 0.8)',
                    borderWidth: 3,
                    pointBackgroundColor: 'rgba(90, 103, 216, 1)',
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: getChartOptions('line')
        });

        // Fonction pour les options communes
        function getChartOptions(type) {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: type === 'line',
                        position: 'top',
                        labels: {
                            font: {
                                family: 'Inter',
                                size: 13
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(45, 55, 72, 0.95)',
                        titleFont: {
                            size: 14,
                            weight: 'bold',
                            family: 'Inter'
                        },
                        bodyFont: {
                            size: 13,
                            family: 'Inter'
                        },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: type === 'line',
                        callbacks: {
                            label: function(context) {
                                return type === 'line' 
                                    ? `${context.dataset.label}: ${context.parsed.y.toLocaleString()}`
                                    : context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            stepSize: type === 'bar' ? 1 : undefined,
                            font: {
                                family: 'Inter'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: 'Inter',
                                weight: '500'
                            }
                        }
                    }
                }
            };
        }
    });
</script>
@endsection