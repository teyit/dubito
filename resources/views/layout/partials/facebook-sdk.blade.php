@section('script')
@parent
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '213471075795721',
            xfbml      : true,
            version    : 'v2.8'
        });

        FB.api('/', 'GET', {
            "fields" : 'id,share,og_object{id,title,type,updated_time,url,picture}',
            "id" : 'http://stackoverflow.com'
        }, function(response) {
                    // Insert your code here
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@endsection