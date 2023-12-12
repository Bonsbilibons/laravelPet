<script src="{{ asset('/assets/js/socket.io.js') }}"></script>
<script>
    var socket = io('http://127.0.0.1:3000');
    socket.on('connect', () => {
        console.log('Connected to Socket.IO:', socket.id);
    });

    socket.on("laravel_database_common-connection/{{ Auth::user()->id }}", function(data){
        showAlert(data.event.message);
    });
    function showAlert(message) {
        console.log(message);
        $('#alert .alert-message').html(message);
        $('#alert').fadeIn();
        setTimeout(function () {
            $('#alert').fadeOut();
        }, 5000)
    }
    $(document).on('click', '.alert-close', function() {
        $('#alert').fadeOut();
    })
</script>
