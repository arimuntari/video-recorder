<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 11/20/2020
 * Time: 8:47 PM
 */

?>


<html>
<head>
    <meta charset="utf-8">
    <title>UTS Komputer Vision</title>

    <link href="https://vjs.zencdn.net/7.10.1/video-js.min.css" rel="stylesheet">
    <link href="https://unpkg.com/videojs-record/dist/css/videojs.record.min.css" rel="stylesheet">
    <link href="videojs-record/examples/assets/css/examples.css" rel="stylesheet">

    <script src="https://vjs.zencdn.net/7.10.1/video.min.js"></script>
    <script src="https://unpkg.com/recordrtc/RecordRTC.js"></script>
    <script src="https://unpkg.com/webrtc-adapter/out/adapter.js"></script>

    <script src="https://unpkg.com/videojs-record/dist/videojs.record.min.js"></script>

    <script src="videojs-record/examples/browser-workarounds.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="bower_components/boostrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/font-awesome/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body cz-shortcut-listen="true">
<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                     stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2"
                     viewBox="0 0 24 24" focusable="false">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
                <strong>Video Recorder</strong>
            </a>
        </div>
    </div>
</header>
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <video id="myVideo" playsinline class="video-js vjs-default-skin">

                    </video>
                </div>
                <div class="col-md-5" id="load-table">
                    <?php
                    include "../video/table.php";
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/boostrap/dist/js/bootstrap.min.js"></script>
<script>
    var options = {
        controls: true,
        bigPlayButton: false,
        width: 600,
        height: 400,
        fluid: false,
        plugins: {
            record: {
                audio: true,
                video: true,
                maxLength: 30,
                debug: true
            }
        }
    };

    // apply some workarounds for opera browser
    applyVideoWorkaround();

    var player = videojs('myVideo', options, function () {
        // print version information at startup
        var msg = 'Using video.js ' + videojs.VERSION +
            ' with videojs-record ' + videojs.getPluginVersion('record') +
            ' and recordrtc ' + RecordRTC.version;
        videojs.log(msg);
    });

    // error handling
    player.on('deviceError', function () {
        console.log('device error:', player.deviceErrorCode);
    });

    player.on('error', function (element, error) {
        console.error(error);
    });

    // user clicked the record button and started recording
    player.on('startRecord', function () {
        console.log('started recording!');
    });

    // user completed recording and stream is available
    player.on('finishRecord', function () {
        // the blob object contains the recorded data that
        // can be downloaded by the user, stored on server etc.
        console.log(player.recordedData);

        var data = player.recordedData;
        var serverUrl = 'simpanfoto.php';
        var formData = new FormData();
        formData.append('foto', data, data.name);

        console.log('uploading recording:', data.name);

        fetch(serverUrl, {
            method: 'POST',
            body: formData
        }).then(
            success => $('#load-table').load("table.php")
        ).catch(
            error => console.error('an upload error occurred!')
        );
    });
</script>

</body>
</html>