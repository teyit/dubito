@include("layout.header")
<body>
<div class="be-wrapper be-fixed-sidebar">
@include("layout.navbar")
@include("layout.sidebar")
    <div class="be-content">
        @yield("content")
    </div>
</div>
@include("layout.footer")