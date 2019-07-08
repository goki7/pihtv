<?php
require_once "assets/config/config.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>πHTV</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="assets/images/pi.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/revealjs/css/reveal.css">
    <link rel="stylesheet" href="/assets/revealjs/css/theme/black.css">

    <!-- Theme used for syntax highlighting of code -->
    <link rel="stylesheet" href="/assets/revealjs/lib/css/zenburn.css">
    <style>
        html, body {
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
        }

        #admin {
            position: fixed;
            top: 0;
            right: 0;
            display: none;
            z-index:999;
        }
    </style>
</head>
<body>
<div class="reveal">
    <div class="slides">
        <section hidden>
        </section>
    </div>
</div>

<button id="admin" onclick="location.href='/admin'" class="btn btn-primary btn-lg btn-block">Admin</button>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"
        integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script src="/assets/revealjs/lib/js/head.min.js"></script>
<script src="/assets/revealjs/js/reveal.js"></script>

<script>
    Reveal.initialize({
        dependencies: [
            { src: '/assets/revealjs/plugin/markdown/marked.js' },
            { src: '/assets/revealjs/plugin/markdown/markdown.js' },
            { src: '/assets/revealjs/plugin/notes/notes.js', async: true },
            { src: '/assets/revealjs/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } }
        ],
        controls: false,
        progress: false,
        slideNumber: false,
        loop: true,
        autoSlide: 1000,
        autoSlideStoppable: false,
        autoSlideMethod: Reveal.navigateNext,
        display: 'block',
    });
</script>

<script src="/assets/include/show.js"></script>
<script>
    $(document).ready(() => {
        $(document).on('mouseenter', 'html', () => {
            $("#admin").show();
        }).on('mouseleave', 'html', () => {
            $("#admin").hide();
        });
    });
</script>
</body>
</html>
