<script>
    //Code from http://www.webdeveloper.com/forum/showthread.php?267853-Auto-refresh-page-once-only-after-first-load, retrieved 10th December 2017--->
    (function() {
        if( window.localStorage ) {
            if( !localStorage.getItem( 'firstLoad' ) ) {
                localStorage[ 'firstLoad' ] = true;
                window.location.reload();
            }  
            else
                localStorage.removeItem( 'firstLoad' );
        }
    })();
</script>