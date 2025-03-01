@extends('layouts.master')

@section('title', 'Admin | Livraison')

@section('content')
<style>
    .simplebar-scrollable-x {
        height: 300px;
        overflow-y: auto;
    }

    .simplebar-content-wrapper {
        overflow-y: auto;
        height: 100%;
    }

    #dash-card-items {
        height: fit-content !important;
    }
</style>
<div class="home">
    @include('layouts.sideBarAdmin')
    <div class="main pb-5">
            @include('layouts.nav')

                <!-- Success Message -->
               @if(session('success'))
                    <div style="color: green;">
                        {{ session('success') }}
                    </div>
                @endif
               <!-- error Message -->
               @if(session('error'))
                    <div style="color: red;">
                        {{ session('error') }}
                    </div>
                @endif
            <!-- End Message -->

            <div class="card right-side mx-lg-3 mt-5 p-3">
                <h4 class="m-0">Tableau de bord / Globale</h4>
            </div>
            <div class="card right-side mx-lg-3 mt-3">
                <div class="card-body p-3 pb-0">
                    <div id="dash-card-items" class="card-body p-2 pb-0 simplebar-scrollable-x" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: -24px -24px 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                        aria-label="scrollable content" style="height: auto; overflow: scroll hidden;">
                                        <div class="simplebar-content">
                                            <div class="row flex-nowrap">

                                                <div class="col">
                                                    <div class="card primary-gradient">
                                                        <div class="card-body text-center px-9 pb-4">
                                                            <div
                                                                class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                                                                <i class='bx bx-dollar text-light fs-7'></i>
                                                            </div>
                                                            <h6 class="fw-normal fs-3 mb-1">Chiffre d'affaires</h6>
                                                            <h4
                                                                class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                                                0 Dhs</h4>
                                                            <span
                                                                class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                                Details</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="card warning-gradient">
                                                        <div class="card-body text-center px-9 pb-4">
                                                            <div
                                                                class="d-flex align-items-center justify-content-center round-48 rounded text-bg-warning flex-shrink-0 mb-3 mx-auto">
                                                                <i class='bx bx-package text-light fs-7'></i>
                                                            </div>
                                                            <h6 class="fw-normal fs-3 mb-1">Total Colis</h6>
                                                            <h4
                                                                class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                                                2</h4>
                                                            <span
                                                                class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                                Details</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="card success-gradient">
                                                        <div class="card-body text-center px-9 pb-4">
                                                            <div
                                                                class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto">
                                                                <i class='bx bxs-package text-light fs-7'></i>
                                                            </div>
                                                            <h6 class="fw-normal fs-3 mb-1">Colis livrés</h6>
                                                            <h4
                                                                class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                                                0</h4>
                                                            <span
                                                                class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                                Details</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="card danger-gradient">
                                                        <div class="card-body text-center px-9 pb-4">
                                                            <div
                                                                class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                                                                <i class='bx bxs-error-circle text-light fs-7'></i>
                                                            </div>
                                                            <h6 class="fw-normal fs-3 mb-1">Colis Refuse</h6>
                                                            <h4
                                                                class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                                                0</h4>
                                                            <span
                                                                class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                                Details</span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 397px; height: 278px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                            <div class="simplebar-scrollbar"
                                style="width: 180px; display: block; transform: translate3d(43px, 0px, 0px);"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-6 right-side mx-lg-3 mt-3">
                <h4 class="p-3 m-0">Top 10 Villes</h4>
            </div>
            <div class="card col-6 right-side mx-lg-3 mt-3">
                <div class="card-body p-3">
                    <div id="chart-bar-basic" style="min-height: 365px;"></div>

                </div>
            </div>

        </div>
    </div>

</div>
<script src="https://unpkg.com/simplebar@5.3.4/dist/simplebar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    new SimpleBar(document.querySelector('.simplebar-scrollable-x'));
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Basic Bar Chart -------> BAR CHART
        var options_basic = {
            series: [
                {
                    data: [140, 120, 118, 100, 80, 75, 35, 32, 20, 0],
                },
            ],
            chart: {
                fontFamily: "inherit",
                type: "bar",
                height: 350,
                toolbar: {
                    show: false,
                },
            },
            grid: {
                borderColor: "transparent",
            },
            colors: ["var(--bs-primary)"],
            plotOptions: {
                bar: {
                    horizontal: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            xaxis: {
                categories: [
                    "Agadir",
                    "Ait melloul",
                    "Azrou",
                    "Inzgane",
                    "Marrakech",
                    "Casa",
                    "Rabat",
                    "Tanger",
                    "Oujda",
                ],
                labels: {
                    style: {
                        colors: "#a1aab2",
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "#a1aab2",
                    },
                },
            },
            tooltip: {
                theme: "dark",
            },
        };

        var chart_bar_basic = new ApexCharts(
            document.querySelector("#chart-bar-basic"),
            options_basic
        );
        chart_bar_basic.render();
    }
    )
</script>
@endsection