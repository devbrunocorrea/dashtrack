@extends('layouts.guest')

@section('title', 'DashTrack - Dashboard de Indicadores')

@section('content')
<div class="container">
  <div class="row">
    <!-- Title Section -->
    <div class="col-12 text-center mt-5">
      <h1 class="display-4">Bem-vindo ao <span class="text-primary">DashTrack</span></h1>
      <p class="lead">A melhor solução para gerenciar seus indicadores e métricas personalizadas de forma eficiente e inteligente.</p>
      <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Já tem uma conta? Faça Login</a>
    </div>
  </div>

  <!-- Pricing Section -->
  <div class="row mt-5">
    <div class="col-12 text-center">
      <h2 class="font-weight-bold">Escolha o seu plano</h2>
      <p>Escolha o plano que melhor atende suas necessidades e comece a monitorar seus indicadores com facilidade.</p>
    </div>
  </div>

  <!-- Plans Section -->
  <div class="row mt-4">
    <!-- Basic Plan -->
    <div class="col-lg-6 mb-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Plano Básico</h3>
        </div>
        <div class="card-body">
          <h4 class="text-primary">$9,99/mês</h4>
          <ul class="list-unstyled">
            <li><i class="fas fa-check text-success"></i> Até 10 Indicadores Personalizados</li>
            <li><i class="fas fa-check text-success"></i> Dashboard Básico</li>
            <li><i class="fas fa-check text-success"></i> Suporte por Email</li>
          </ul>
          <a href="#" class="btn btn-primary btn-block">Assinar Plano Básico</a>
        </div>
      </div>
    </div>

    <!-- Advanced Plan -->
    <div class="col-lg-6 mb-4">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Plano Avançado</h3>
        </div>
        <div class="card-body">
          <h4 class="text-success">$29,99/mês</h4>
          <ul class="list-unstyled">
            <li><i class="fas fa-check text-success"></i> Indicadores Ilimitados</li>
            <li><i class="fas fa-check text-success"></i> Dashboard Personalizado</li>
            <li><i class="fas fa-check text-success"></i> Suporte Prioritário</li>
            <li><i class="fas fa-check text-success"></i> Relatórios Avançados</li>
          </ul>
          <a href="#" class="btn btn-success btn-block">Assinar Plano Avançado</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Comparison Table -->
  <div class="row mt-5">
    <div class="col-12">
      <h3 class="text-center">Comparação de Planos</h3>
      <table class="table table-bordered table-striped mt-3">
        <thead>
          <tr class="bg-primary text-white">
            <th>Recursos</th>
            <th>Plano Básico</th>
            <th>Plano Avançado</ th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Indicadores Personalizados</td>
            <td>Até 10</td>
            <td>Ilimitados</td>
          </tr>
          <tr>
            <td>Dashboard</td>
            <td>Básico</td>
            <td>Personalizado</td>
          </tr>
          <tr>
            <td>Suporte</td>
            <td>Email</td>
            <td>Prioritário</td>
          </tr>
          <tr>
            <td>Relatórios</td>
            <td>Não disponível</td>
            <td>Avançados</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
