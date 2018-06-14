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
<script src="{{url('/js/assets/notify.min.js')}}"></script>
<script>
    function deleteSite($this) {
        $("#modalDeleteUrl").modal('toggle');
        idSite=$this.prop("id").split('_')[1];
    }
    function editSite($this) {
        idSite=$this.prop("id").split('_')[1];
        $libelle=$this.parent().parent().parent().find("td").first().text();
        $url=$this.parent().parent().find("a").first().text();
        $("#edit_url_libelle").val($libelle);
        $("#edit_url_url").val($url);
        $("#modalEditUrl").modal('toggle');
    }
    function startWith($haystack, $needles) {
        if($needles !== '' && $needles.substr(0, $haystack.length )==$haystack)
        {
            return true;
        }
        return false;
    }
    function dd($var) {
        console.log($var);
    }
</script>