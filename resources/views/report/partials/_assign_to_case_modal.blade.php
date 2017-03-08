<div id="report-assign-to-case" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Assign to Case</h3>

            </div>
            <div class="modal-body">

                        <form method="post" action="" id="report-assign-case-form">
                            {{ csrf_field() }}
                            <div class="form-group ">
                                <label>Cases</label>
                                <select class="form-control report-cases" name="case_id" id="case_id">
                                    <option value="">Select Case</option>
                                    {{--@foreach($cases as $case)--}}
                                        {{--<option value="{{$case->id}}">{{$case->title}}</option>--}}
                                    {{--@endforeach--}}

                                </select>
                            </div>
                            <div class="form-group pull-left">
                                <p class="text-success success-message" style="display: none;">Successfuly was assigned</p>
                            </div>
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-space btn-primary">Assign</button>
                            </div>

                        </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(function(){
        $(document).on('click',".report-assign-case",function () {

            var that = $(this);
            $('#report-assign-to-case').modal({
                show: 'true',
                keyboard: false
            });
            getCases();
            $("#report-assign-case-form").on('submit',function(e){
                var id = that.data('id');
                e.preventDefault();
                $.ajax({
                    url: "/reports/"+id,
                    data: {_token:$("#_token").val(), case_id : $("#case_id").val()},
                    method : "put",
                    success: function(result){
                        if(result == 'true'){
                            $(".success-message").show();
                        }
                    }
                });

            });
        });

    });

    $('#report-assign-to-case').on('hidden.bs.modal', function () {
        $(".success-message").hide();
    });

</script>
@endsection