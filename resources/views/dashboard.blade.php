@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalOrders }}</h3>
                            <p>Pedidos</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalOrdersCanceled }}</h3>
                        <p>Pedidos Cancelados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalOrdersDelivered }}</h3>
                            <p>Pedidos Entregues</p>
                        </div>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalOrdersDoneToDelivery }}</h3>
                            <p>Pedidos Pronto Para Entregar</p>
                        </div>
                        </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                <div class="col-lg-3 col-6">
                 <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalOrdersIncompleteData }}</h3>
                        <p>Pedidos Incompletos</p>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <canvas id="ordersChart" style="width:100%;max-width:700px"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    var labels = [];
    var values = [];

    @foreach ($sales as $label => $value)
        labels.push("{{ $label }}");
        values.push({{ $value }});
    @endforeach

    console.log(labels);
    console.log(values);

    var ctx = document.getElementById('ordersChart').getContext('2d');
    var ordersChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Vendas',
                data: values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ]
            }]
        }
    });

    setInterval(function(){
        location.reload();
    }, 5000);
</script>
@endsection
