@include('layout.partials._confirm_modal')


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
<script src="{{url('assets/lib/select2/js/select2.full.js')}}" type="text/javascript"></script>
<script src="{{url("assets/js/dubito.js")}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script src="{{url('https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.html5.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.flash.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.print.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.colVis.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js')}}" type="text/javascript"></script>


<script src="{{url('assets/lib/jquery.gritter/js/jquery.gritter.js')}}"></script>
<script src="{{url('assets/js/app-tables-datatables.js')}}" type="text/javascript"></script>
<script src="{{url("assets/lib/jquery.magnific-popup/jquery.magnific-popup.min.js")}}" type="text/javascript"></script>
<script src="{{url('assets/js/app-page-gallery.js')}}" type="text/javascript"></script>
<script src="{{url('assets/lib/masonry/masonry.pkgd.min.js')}}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.js"></script>

<script src="{{url('assets/lib/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js')}}"></script>

@yield('script')



<script type="text/javascript">


    $(document).ready(function(){

        App.dashboardAutocomplete()
        App.init();
        App.dataTables();


        $(".select2").select2({
            width: '100%'
        });

        $('b[role="presentation"]').hide();

        $('.select2-arrow').append('<i class="fa fa-angle-down"></i>');




        $(window).on('load',function(){
            App.pageGallery();

        });

    });
</script>

<style>

    .ui-autocomplete  {
        width:734px !important;
        padding:10px !important;
    }

    .ui-autocomplete li a {
        overflow: hidden;
        display: block;
    }
    .ui-autocomplete li a img {
        float: left;
        margin-right: 10px;
        height: 40px;
    }
    .ui-autocomplete li a .text {
        display: block;
        font-size: 16px;
        line-height: 17px;
        float:left;
    }
    .ui-autocomplete li a .category {
        display: block;
        font-size: 14px;
        color: #999;
        float:right
    }

    .ui-autocomplete li a .folder {
        display: block;
        font-size: 12px;
        color: #999;
        float:right;
        padding:0 5px;
    }

    .ui-autocomplete { height: 300px; overflow-y: scroll; overflow-x: hidden;}


    .select2-container--default .select2-selection--single{
        padding:6px;
        height: 48px;
        width: 100%;
        font-size: 1.5em;
        position: relative;
    }

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #fff transparent !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #fff transparent transparent transparent !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 35px;
        font-size: 15px;
    }



</style>




</body>
</html>