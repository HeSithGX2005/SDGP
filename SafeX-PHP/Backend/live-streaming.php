<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebSocket Video Stream</title>
</head>
<body>
    <video id="videoPlayer" autoplay></video>

    <script>
        const videoPlayer = document.getElementById('videoPlayer');
        const ws = new WebSocket('ws://127.0.0.1:5000'); // Connect to your WebSocket server

        ws.onmessage = function(event) {
            if (typeof event.data === 'string') {
                // Handle non-video data (if any)
                console.log('Received message:', event.data);
            } else {
                // Assuming video frames are sent as binary data
                const blob = new Blob([event.data], { type: 'video/mp4' });
                const objectURL = URL.createObjectURL(blob);
                videoPlayer.src = objectURL;
            }
        };

        ws.onerror = function(event) {
            console.error('WebSocket error:', event);
        };
    </script>
</body>
</html>
