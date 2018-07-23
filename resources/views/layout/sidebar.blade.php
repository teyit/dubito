<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>

                        <li class="{{request()->segment(1) == '' ? "active" : ""}}"><a href="{{url("/")}}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                        </li>
                        @if(request()->user()->hasRole("Admin"))
                        <li class="{{request()->segment(1) == 'messages' ? "active" : ""}}" ><a  href="{{url("/messages/")}}"><i class="icon mdi mdi-inbox"></i><span>Messages</span></a></li>

                        <li class="{{request()->segment(1) == 'reports' ? "active" : ""}}" ><a  href="{{url("/reports/")}}"><i class="icon mdi mdi-accounts-alt"></i><span>Reports</span></a></li>
                        @endif

                     
                        <li class="parent {{request()->segment(1) == 'case' ? 'open' : ''}}">
                            <a href="#"><i class="icon mdi mdi-case-check"></i><span>Cases</span></a>
                            <ul class="sub-menu">
                                @if(request()->user()->hasRole("Admin"))
                                <!--<li class="{{request()->is('case/new') ?  'active' : ''}}"><a href="{{url("/case/new")}}">New</a></li>-->
                                @endif
                                <li class="{{request()->is('case/news_feed') ? 'active' : ''}}"><a href="{{url("/case/news_feed")}}">News Feed</a></li>
                                <li class="{{request()->is('case/cold_cases') ?  'active' : ''}}"><a href="{{url("/case/cold_cases")}}">Cold Cases</a></li>
                                <li class="{{request()->is('case/archive') ? 'active' : ''}}"><a href="{{url("/case/archive")}}">Archive</a></li>
                            </ul>
                        </li>

                        <!--
                        <li class="{{request()->segment(1) == 'topics' ? "active" : ""}}"><a  href="{{url("/topics/")}}"><i class="icon mdi mdi-labels"></i>Topics</a></li>
                        -->
                        <li class="{{request()->segment(1) == 'categories' ? "active" : ""}} "><a href="{{url("/categories/")}}"><i class="icon mdi mdi-format-list-bulleted"></i><span>Categories</span></a></li>

                        <li class="{{request()->segment(1) == 'tags' ? "active" : ""}}"><a  href="{{url("/tags")}}"><i class="icon mdi mdi-label-alt"></i><span>Tags</span></a></li>
                        @if(request()->user()->hasRole("Admin"))

                        <!--
                        <li class="{{request()->segment(1) == 'reviews' ? "active" : ""}}"><a  href="{{url("/reviews")}}"><i class="icon mdi mdi-comment"></i> Reviews</a></li>

                        <li class="{{request()->segment(1) == 'logs' ? "active" : ""}}"><a  href="{{url("/logs")}}"><i class="icon mdi mdi-storage"></i> Logs</a></li>
                        -->
                        <li class="{{request()->segment(1) == 'users' ? "active" : ""}}"><a  href="{{url("/users")}}"><i class="icon mdi mdi-account-add"></i><span>Users</span></a></li>

                    @endif

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>