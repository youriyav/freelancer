@extends('prestataire.moncompte.layout')
@section('menu')
    <ul class="nav nav-list" >
        <li ><a href="{{route('monCompte')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('mesProjets')}}"><i class="fa fa-briefcase"></i> Mes Projets</a></li>
        <li class="myActive"><a href="{{route('mesCompetences')}}"><i class="fa fa-briefcase"></i> Mes compétences</a></li>
    </ul>
@endsection()
@section('compte_css')
    <link href="{{url('/css/assets/jquery-ui.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/chosen.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/uniform.default.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/jquery.inputlimiter.1.0.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/colorpicker.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/jquery.tagsinput.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/daterangepicker-bs3.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/datepicker.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/bootstrap-switch.css')}}" rel="stylesheet" />
@endsection
@section('main_content_compte')
    <div class="panel panel-default">
        <div class="panel-heading text-primary">
            <h4 class="text-primary">Mes compétences</h4>
            <!--a href=""><i class="fa fa-edit pull-right fa-2x"></i></a-->
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table  table-bordered ">
                    <tbody>
                    <tr>
                        <th width="30%">Langue(s) parlée(s)</th>
                        <td>
                            <form class="form-horizontal">
                                <select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">
                                    @foreach($listeLangue as $langue)
                                        <option  value="{{$langue->id}}" @foreach(Auth::user()->langues as $langue2) @if($langue2->id==$langue->id) selected @endif @endforeach >{{$langue->libelle}}</option>
                                    @endforeach
                                </select>
                                <div class="hidden blocBtn" style="margin-top: 8px">
                                    <button class="btn btn-sm btn-primary pull-right btnSaveEdit" id="1"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                    <button class="btn btn-sm btn-danger pull-right btnCancelEdit" id="1" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;

                                </div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Technologies</th>
                        <td>
                            <form class="form-horizontal">
                                <select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">
                                    @foreach($listeOfPlat as $plat)
                                        <option value="82" style="background-color:#888888; font-weight: bold;text-transform: uppercase;color: white" disabled=""> ----- {{$plat->libelle}} ----- </option>
                                        <span class="main_select">@foreach($plat->technologies as $techno)
                                            <option  value="{{$techno->id}}" @foreach(Auth::user()->technologies as $tech) @if($tech->id==$techno->id) selected @endif @endforeach >{{$techno->libelle}}</option>
                                        @endforeach</span>
                                    @endforeach
                                </select>
                                <div class="hidden blocBtn" style="margin-top: 8px">
                                    <button class="btn btn-sm btn-primary pull-right btnSaveEdit" id="2"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                    <button class="btn btn-sm btn-danger pull-right btnCancelEdit" id="2" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;

                                </div>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading text-primary">
            <h4 class="text-primary">Mes réalisations<button class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i></button></h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th>Login</th>
                        <td>Mark</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('footer')
    <a href="#" class="btn btn-primary">My Sales Performance</a>
    <a href="#" class="btn btn-primary">Team Sales Performance</a>
@endsection()
@section('compte_js')
    <script src="{{url('/js/assets/jquery-ui.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.uniform.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.inputlimiter.1.3.1.min.js')}}"></script>
    <script src="{{url('/js/assets/chosen.jquery.min.js')}}"></script>

    <script src="{{url('/js/assets/bootstrap-colorpicker.js')}}"></script>
    <script src="{{url('/js/assets/jquery.tagsinput.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.validVal.min.js')}}"></script>
    <script src="{{url('/js/assets/daterangepicker.js')}}"></script>
    <script src="{{url('/js/assets/moment.min.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-switch.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.dualListBox-1.3.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.autosize.min.js')}}"></script>

    <script src="{{url('/js/assets/formsInit.js')}}"></script>
    <script>
        $(function () {
            formInit();
            $(".chzn-select").change(function () {
                $this=$(this);
                $blocBtn=$this.parent().find(".blocBtn");
                $blocBtn.removeClass('hidden');
            });
            $(".btnCancelEdit").click(function (e) {
                e.preventDefault();
                mtype=$(this).attr('id');
                $this=$(this);
                $form=$this.parent().parent();
                $this.parent().addClass("hidden");
                if(mtype==1)
                {
                    _html='<select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">\n';
                    check=0;

                    for(j=0;j<listeLangue.length;j++)
                    {
                        check=0;
                            for(y=0;y<listeUserLangue.length;y++)
                            {
                                if(listeLangue[j].id==listeUserLangue[y].id)
                                {
                                    check=1;
                                }
                            }
                            if(check==1)
                            {
                                _html+='<option  value="'+listeLangue[j].id+'"  selected>'+listeLangue[j].libelle+'</option>'
                            }
                            else
                            {
                                _html+='<option  value="'+listeLangue[j].id+'"  >'+listeLangue[j].libelle+'</option>'
                            }
                    }



                    _html+='</select>';
                    $form.html(_html);
                }
                else
                {
                    console.log(listeOfPlat);
                    console.log(listeOfTechnologies);
                    _html='<select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">';
                    check=0;
                    for(i=0;i<listeOfPlat.length;i++)
                    {
                        _html+='<option value="82" style="background-color:#888888; font-weight: bold;text-transform: uppercase;color: white" disabled=""> ----- '+listeOfPlat[i].libelle+' ----- </option>';
                        for(j=0;j<listeOfTechnologies.length;j++)
                        {
                            check=0;
                            if(listeOfPlat[i].id==listeOfTechnologies[j].plateforme_id)
                            {
                                for(y=0;y<listeUserTechno.length;y++)
                                {
                                    if(listeOfTechnologies[j].id==listeUserTechno[y].id)
                                    {
                                        check=1;
                                    }
                                }
                                if(check==1)
                                {
                                    _html+='<option  value="'+listeOfTechnologies[j].id+'"  selected>'+listeOfTechnologies[j].libelle+'</option>'
                                }
                                else
                                {
                                    _html+='<option  value="'+listeOfTechnologies[j].id+'"  >'+listeOfTechnologies[j].libelle+'</option>'
                                }

                            }
                        }
                    }
                    _html+='</select>';
                    $form.html(_html);
                }
                formInit();

            });
            $(".btnSaveEdit").click(function (e) {
                e.preventDefault()
                mtype=$(this).attr('id');
                var $this = $(this);
                $select=$this.parent().parent().find('select');
                route="";
                data="";
                if(mtype==1)
                {
                    route="/update-langues";
                    data={"idPrestataire":{{Auth::user()->id}},"langues":$select.val(),"_token":"<?php echo csrf_token() ?>"};
                }
                if(mtype==2)
                {
                    route="/update-technologies";
                    data={"idPrestataire":{{Auth::user()->id}},"technologies":$select.val(),"_token":"<?php echo csrf_token() ?>"};
                }

                $this.button('loading');
                $.ajax({
                    url :route,
                    data:data,
                    type : "post",
                    success : function(json)
                    {
                        if(mtype==1)
                        {
                            listeUserLangue=JSON.parse(json);
                        }
                        else
                        {
                            listeUserTechno=JSON.parse(json);
                        }

                        console.log(listeUserTechno);
                        $this.button('reset');
                        $this.parent().addClass('hidden');
                    },
                    error :function(xhr,errmsg,err)
                    {
                        console.log(xhr);
                        $this.button('reset');
                    }
                });
            });

        });
    </script>

@endsection