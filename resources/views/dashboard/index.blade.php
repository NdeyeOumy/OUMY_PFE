@extends('layouts.main')

@section('title', "Tableau de bord")

@section('cssblock')
    <!-- Custom CSS -->
    <style>
        .tile_stats_count {
            text-align: center;
        }
        .tile_stats_count .count {
            font-size: 28px;
            font-weight: bold;
        }
        .tile_stats_count .count_bottom {
            font-size: 14px;
        }
        .progress-bar {
            line-height: 20px;
            color: white;
        }
        .progress_sm {
            height: 10px;
        }
        .x_title h2 {
            font-size: 20px;
            font-weight: bold;
        }
        .x_title .nav .fa {
            font-size: 16px;
        }
        .widget_summary .w_left span, .widget_summary .w_right span {
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline-block;">
            <div class="tile_count">
                <div class="col-md-2 col-sm-4 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Utilisateurs</span>
                    <div class="count">{{ $totalUsers }}</div>
                    <span class="count_bottom"><i class="green">4% </i> Depuis la semaine dernière</span>
                </div>
                <div class="col-md-2 col-sm-4 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Clients</span>
                    <div class="count">{{ $totalClients }}</div>
                    <span class="count_bottom"><i class="green">4% </i> Depuis la semaine dernière</span>
                </div>
                <div class="col-md-2 col-sm-4 tile_stats_count">
                    <span class="count_top"><i class="fa fa-cube"></i> Total Produits</span>
                    <div class="count">{{ $totalProduits }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> Depuis la semaine dernière</span>
                </div>
                <div class="col-md-2 col-sm-4 tile_stats_count">
                    <span class="count_top"><i class="fa fa-shopping-cart"></i> Total Ventes</span>
                    <div class="count">{{ $totalVentes }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Depuis la semaine dernière</span>
                </div>
                <div class="col-md-2 col-sm-4 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Chiffre d'affaires</span>
                    <div class="count">{{ $totalRevenue }}</div>
                    <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> Depuis la semaine dernière</span>
                </div>
                {{-- <div class="col-md-2 col-sm-4 tile_stats_count">
                    <span class="count_top"><i class="fa fa-truck"></i> Stocks</span>
                    <div class="count">{{ $totalStock }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Depuis la semaine dernière</span>
                </div> --}}
            </div>
        </div>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="dashboard_graph">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>Activités du Réseau <small>Graphique des ventes</small></h3>
                        </div>
                        <div class="col-md-6">
                            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>July 1, 2024 - July 31, 2024</span> <b class="caret"></b>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-9">
                        <div id="chart_sales" class="demo-placeholder"></div>
                    </div>
                    <div class="col-md-3 col-sm-3 bg-white">
                        <div class="x_title">
                            <h2>Performance des Produits</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div>
                                <p>Produit A</p>
                                <div class="">
                                    <div class="progress progress_sm" style="width: 76%;">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>Produit B</p>
                                <div class="">
                                    <div class="progress progress_sm" style="width: 76%;">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>Produit C</p>
                                <div class="">
                                    <div class="progress progress_sm" style="width: 76%;">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
        {{-- <br />

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>Versions de l'Application</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Paramètres 1</a>
                                    <a class="dropdown-item" href="#">Paramètres 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <h4>Utilisation de l'application par version</h4>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>v1.0</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" style="width: 66%;">
                                        <span class="sr-only">66% Complété</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>123k</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>v2.0</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-blue" role="progressbar" style="width: 30%;">
                                        <span class="sr-only">30% Complété</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>53k</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /row -->
    </div>
    <!-- /page content -->
@endsection

@section('jsblock')

@endsection