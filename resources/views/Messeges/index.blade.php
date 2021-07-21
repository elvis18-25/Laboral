<!DOCTYPE html>
<html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b94f0b012a3d0bf93748', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('form-submit', function(data) {
      alert(JSON.stringify(data.text));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>
</html>