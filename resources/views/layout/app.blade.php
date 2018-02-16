@include("layout.header")
<body>
<div class="be-wrapper be-collapsible-sidebar be-collapsible-sidebar-collapsed {{$css or ''}}">

    @include("layout.navbar")
@include("layout.sidebar")
    <div class="be-content">
        @yield("content")
    </div>
</div>

@include("layout.footer")