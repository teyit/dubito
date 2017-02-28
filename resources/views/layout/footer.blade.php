<script src="{{url("assets/lib/jquery/jquery.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/js/main.js")}}" type="text/javascript"></script>
<script src="{{url("assets/lib/bootstrap/dist/js/bootstrap.min.js")}}" type="text/javascript"></script>
{{--<script src="{{url("assets/lib/jquery-flot/jquery.flot.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{url("assets/lib/jquery-flot/jquery.flot.pie.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{url("assets/lib/jquery-flot/jquery.flot.resize.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{url("assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{url("assets/lib/jquery-flot/plugins/curvedLines.js")}}" type="text/javascript"></script>--}}
<script src="{{url("assets/lib/jquery.sparkline/jquery.sparkline.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/lib/countup/countUp.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/lib/jquery-ui/jquery-ui.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/lib/jqvmap/jquery.vmap.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/lib/jqvmap/maps/jquery.vmap.world.js")}}" type="text/javascript"></script>
<script src="{{url("assets/js/app-dashboard.js")}}" type="text/javascript"></script>
<script src="{{url("assets/js/dubito.js")}}" type="text/javascript"></script>


<script src="{{url('assets/lib/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.html5.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.flash.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.print.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.colVis.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js')}}" type="text/javascript"></script>

@yield('script')

<script type="text/javascript">
    $(document).ready(function(){
        //initialize the javascript
        App.init();
//        App.dashboard();
    });
</script>


</body>
</html>