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

                        <li class="{{request()->segment(1) == 'reports' ? "active" : ""}}"><a  href="{{url("/reports/")}}"><i class="icon mdi mdi-comment-alert"></i>Reports</a></li>

                        <li class="parent {{request()->segment(1) == 'case' ? 'open' : ''}}">
                            <a href="#"><i class="icon mdi mdi-case-check"></i>Cases</a>
                            <ul class="sub-menu">
                                <li class="{{request()->segment(2) == 'ongoing' ? 'active' : ''}}"><a href="{{url("/case/ongoing")}}">Ongoing</a></li>
                                <li class="{{request()->segment(2) == 'archived' ? 'active' : ''}}"><a href="{{url("/case/archived")}}">Archived</a></li>
                                <li class="{{request()->segment(2) == 'backlog' ? 'active' : ''}}"><a href="{{url("/case/backlog")}}">Backlog</a></li>

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