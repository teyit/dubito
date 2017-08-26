<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>


                        <li class="{{request()->segment(1) == '' ? "active" : ""}}"><a href="{{url("/")}}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                        </li>

                        <li class="{{request()->segment(1) == 'messages' ? "active" : ""}}" ><a  href="{{url("/messages/")}}"><i class="icon mdi mdi-local-post-office"></i>Messages</a></li>

                        <li class="parent {{request()->segment(1) == 'report' ? 'open' : ''}}">
                            <a href="#"><i class="icon mdi mdi-comment-alert"></i>Reports</a>
                            <ul class="sub-menu">
                                <li class="{{request()->is('report/ongoing') ? 'active' : ''}}"><a href="{{url("/report/ongoing")}}">Ongoing</a></li>
                                <li class="{{request()->is('report/archived') ? 'active' : ''}}"><a href="{{url("/report/archived")}}">Archived</a></li>
                                <li class="{{request()->is('report/backlog') ?  'active' : ''}}"><a href="{{url("/report/backlog")}}">Backlog</a></li>

                            </ul>
                        </li>


                        <li class="parent {{request()->segment(1) == 'case' ? 'open' : ''}}">
                            <a href="#"><i class="icon mdi mdi-case-check"></i>Cases</a>
                            <ul class="sub-menu">
                                <li class="{{request()->is('case/new') ?  'active' : ''}}"><a href="{{url("/case/new")}}">New</a></li>
                                <li class="{{request()->is('case/news_feed') ? 'active' : ''}}"><a href="{{url("/case/news_feed")}}">News Feed</a></li>
                                <li class="{{request()->is('case/cold_cases') ?  'active' : ''}}"><a href="{{url("/case/cold_cases")}}">Cold Cases</a></li>
                                <li class="{{request()->is('case/archive') ? 'active' : ''}}"><a href="{{url("/case/archive")}}">Archive</a></li>

                            </ul>
                        </li>

                        <li class="{{request()->segment(1) == 'topics' ? "active" : ""}}"><a  href="{{url("/topics/")}}"><i class="icon mdi mdi-labels"></i>Topics</a></li>

                        <li class="{{request()->segment(1) == 'categories' ? "active" : ""}} "><a href="{{url("/categories/")}}"><i class="icon mdi mdi-format-list-bulleted"></i>Categories</a></li>

                        <li class="{{request()->segment(1) == 'tags' ? "active" : ""}}"><a  href="{{url("/tags")}}"><i class="icon mdi mdi-tag"></i> Tags</a></li>

                        <li class="{{request()->segment(1) == 'reviews' ? "active" : ""}}"><a  href="{{url("/reviews")}}"><i class="icon mdi mdi-comment"></i> Reviews</a></li>

                        <li class="{{request()->segment(1) == 'logs' ? "active" : ""}}"><a  href="{{url("/logs")}}"><i class="icon mdi mdi-storage"></i> Logs</a></li>


                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>