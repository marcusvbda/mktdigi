<style>
    .loading-content {
        padding: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    img {
        height: 50px;
    }
</style>

<div class="loading-content">
    <img src="{{ asset('/assets/images/loading.gif') }}">
</div>
<script>
    @if($url->pixels->count()) 
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        @foreach($url->pixels as $pixel) 
            fbq('init', '{{ $pixel->id }}');
            fbq('track', 'PageView');
        @endforeach
    @endif
    setTimeout(() => {
        window.location.href = '{{ $url->original_url }}';
    }, 500);
</script>