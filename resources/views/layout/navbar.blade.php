<nav class="navbar navbar-default navbar-fixed-top be-top-header">
    <div class="container-fluid">
        <div class="navbar-header"><a href="{{url("/")}}" class="navbar-brand">dubito</a>
        </div>
        <div class="be-right-navbar be-right-navbar-flex">
            <div class="search-container">
                <div class="input-group input-group-sm">
                    <input  id="search" type="text" name="search" placeholder="Search..." class="form-control search-input"><span class="input-group-btn">
                  <button type="button" class="btn btn-primary">Search</button></span>
                </div>
            </div>


            <ul class="nav navbar-nav navbar-right be-user-nav">

                <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{url("assets/img/avatar.png")}}" alt="Avatar"><span class="user-name">Túpac Amaru</span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li>
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name }} </div>
                                <div class="user-position online">Available</div>
                            </div>
                        </li>
                        <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span class="icon mdi mdi-power"></span>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </li>
            </ul>


        </div>
    </div>
</nav>