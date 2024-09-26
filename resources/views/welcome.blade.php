@extends('layouts.principal')
@section('title', 'Inventario Documental')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay"
        style="background-image: url(homeland/images/hero_bg_2024.jpg); height: 940px;" data-aos="fade"
        data-stellar-background-ratio="0.8">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <h1 class="mb-6">{{ $empresa->nombre }}</h1>
                    <p class="lead" data-aos="fade-up" data-aos-delay="200">Transparencia y Compromiso con la Comunidad</p>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <img src="homeland/images/about.png" alt="Imagen sobre la empresa" class="img-fluid shadow rounded">
                </div>
                <div class="col-md-5 ml-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="card shadow-sm p-4">
                        <div class="site-section-title">
                            <h2><i class="fas fa-bullseye"></i> Misión</h2>
                        </div>
                        <p class="lead">
                            {{ $empresa->mision }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center" data-aos="fade-up">
                <div class="col-md-7">
                    <div class="card shadow-sm p-4 text-center">
                        <div class="site-section-title">
                            <h2><i class="fas fa-eye"></i> Visión</h2>
                        </div>
                        <p>
                            {{ $empresa->vision }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center">
                    <div class="site-section-title">
                        <h2>Visita Nuestro Sitio Web</h2>
                    </div>
                    <p>
                        <a href="{!! $empresa->url !!}" class="btn btn-primary py-3 px-5 rounded-0 btn-2"
                            data-aos="zoom-in" data-aos-delay="300">Ir a la página de Alcaldía Municipal de Puerto Boyacá</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .shadow {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
        }
        .shadow:hover {
            transform: scale(1.05);
        }
        .card {
            border: none;
            background-color: #f8f9fa;
            transition: background-color 0.3s;
        }
        .card:hover {
            background-color: #e9ecef;
        }
        .btn-2 {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-2:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .site-section-title h2 {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        .site-section-title h2:after {
            content: '';
            width: 100%;
            height: 2px;
            background: #007bff;
            position: absolute;
            left: 0;
            bottom: -5px;
            transition: width 0.3s;
        }
        .site-section-title h2:hover:after {
            width: 100%;
        }
    </style>
@endsection
