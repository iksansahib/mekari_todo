<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <input type="text" name="todo" id="todo" /><input type="submit" name="submit" id="submit" /><br />
                <ul id="todos">
                </ul>
                <input type="button" id="deleteSelected" value="Delete Selected">
            </div>
        </div>
    </body>
</html>
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript">
$(function(){
    getTodo();
    $('#submit').click(function(){
        jQuery.post({
            url: 'http://localhost:8000/api/todo',
            data: JSON.stringify({title: $('#todo').val()}),
            dataType: 'json',
            headers: {
                'Content-Type': 'application/json'
            },
            success: function(response){
                getTodo();
            }
        })
    });

    function getTodo(){
        $('#todos').html('');
        jQuery.get({
            url: 'http://localhost:8000/api/todo',
            headers: {
                'Content-Type': 'application/json'
            },
            success: function(response){
                response.forEach((todo)=>{
                    $('#todos').prepend('<li><input class="checked" type="checkbox" value="'+todo.id+'">'+todo.title+'</li>')
                })
            }
        })
    }

    $('#deleteSelected').click(function(){
        $('.checked:checked').each(function(){
            $.ajax({
                type: 'DELETE',
                url: 'http://localhost:8000/api/todo/'+$(this).val(),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        });
        getTodo();
    });
});
</script>
