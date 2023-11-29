<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Main page</title>

</head>

<body>

<h2>Test page</h2>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('test') }}",
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},
            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>

</body>
</html>
