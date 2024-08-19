<!DOCTYPE html>
<html>
    <head>
    <title>Chat Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </head>
    <body>
    <h1>Chat Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>

    <div>

        <div id="display">
            {{-- message will be shown in here --}}
        </div>

        <input type="text" id="message" placeholder="Write Something..." />
        <button type="button" id="send">Send</button>

    </div>



    <script>

        $(document).ready(function(){

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('4d0e24d65929ff5f0893', {
            cluster: 'ap1'
            });

            var channel = pusher.subscribe('chat-channel');
            channel.bind('message-event', function(data) {
            console.log(data);

                $("#display").html(`<p>${data.message}<p>`)

            });

            $("#send").click(function(){

                const message = $("#message").val();

                $.ajax({
                    url:"/chatmessage",
                    type:'POST',
                    data:{
                        sms:message
                    },
                    headers:{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                    success:function(response){
                        console.log(response);
                    }
                })


            });

        });

    </script>

    </body>
</html>
