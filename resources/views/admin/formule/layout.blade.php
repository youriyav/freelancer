@extends('admin.layout')


@extends('admin.layout')


@section('maim_menu')
    <li class="panel ">
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
    <li class="panel active">
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
            &nbsp; <span class="label label-default">{{$GlobalNbrDescriptLangue}}</span>&nbsp;
        </a>
    </li>
@endsection