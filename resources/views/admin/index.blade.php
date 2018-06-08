@extends('admin.layout')
@section('content_main')
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-lg-12">
                <h1> Admin Dashboard </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div style="text-align: center;">
                    <a class="quick-btn" href="{{route('indexProjet',["jour"=>"today"])}}">
                        <i class="fa fa-briefcase fa-2x"></i>
                        <span> Projets</span>
                        <span class="label label-danger">{{count($projets)}}</span>
                    </a>

                    <a class="quick-btn" href="{{route('indexCommande',["jour"=>"today"])}}">
                        <i class="fa fa-money fa-2x"></i>
                        <span> Commandes</span>
                        <span class="label label-danger">{{count($commandes)}}</span>
                    </a>

                    <a class="quick-btn" href="#">
                        <i class="fa fa-users fa-2x"></i>
                        <span>Utilisateurs</span>
                        <span class="label label-success">456</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="fa fa-money fa-2x"></i>
                        <span>Payement</span>
                        <span class="label label-warning">+25</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="fa fa-star fa-2x"></i>
                        <span>Notation</span>
                        <span class="label btn-metis-2">3.14159265</span>
                    </a>

                    <a class="quick-btn" href="#">
                        <i class="fa fa-hand-o-up fa-2x"></i>
                        <span>Offre</span>
                        <span class="label btn-metis-2">20</span>
                    </a>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('maim_menu')
    <li class="panel active">
        <a href="{{route('indexAdmin')}}" >
            <i class="icon-table"></i> Dashboard


        </a>
    </li>

    <li class="panel ">
        <a href="{{route('indexPlateformeAdmin')}}" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
            <i class="icon-tasks"> </i> Plateformes

            <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
            &nbsp; <span class="label label-default">{{$GlobalNbrPlateForme}}</span>&nbsp;
        </a>

    </li>
    <li class="panel ">
        <a href="{{route('indextechologiesAdmin')}}" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
            <i class="icon-tasks"> </i> Technologies

            <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
            &nbsp; <span class="label label-default">{{$GlobalNbrTechnologies}}</span>&nbsp;
        </a>
    </li>
    <li class="panel">
        <a href="{{route('indextechologiesAdmin')}}" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
            <i class="icon-tasks"> </i> Budgets

            <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
            &nbsp; <span class="label label-default">{{$GlobalNbrBudget}}</span>&nbsp;
        </a>
    </li>
    <li class="panel">
        <a href="{{route('descriptFormule')}}" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
            <i class="icon-tasks"> </i> Description Formules

            <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
            &nbsp; <span class="label label-default">{{$GlobalNbrDescriptFormule}}</span>&nbsp;
        </a>
    </li>
    <li class="panel ">
        <a href="{{route('indexFormuleAdmin')}}" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
            <i class="icon-tasks"> </i> Formules

            <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
            &nbsp; <span class="label label-default">{{$GlobalNbrFormule}}</span>&nbsp;
        </a>
    </li>
    <li class="panel">
        <a href="{{route('indexLangue')}}" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
            <i class="icon-tasks"> </i> Langues

            <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
            &nbsp; <span class="label label-default bg-red">{{$GlobalNbrDescriptLangue}}</span>&nbsp;
        </a>
    </li>
@endsection