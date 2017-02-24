

    <div class="panel panel-default">
        <div class="panel-heading">Report Files</div>
        <br>
        <div class="tab-container">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#active" data-toggle="tab">Active Files</a></li>
                <li><a href="#passive" data-toggle="tab">Passive Files</a></li>
            </ul>
            <div class="tab-content">

                <div id="active" class="tab-pane active">
                   @include('report.partials._active_file_table')
                </div>
                <div id="passive" class="tab-pane">
                    @include('report.partials._passive_file_table')
                </div>

            </div>
        </div>
    </div>
</div>

