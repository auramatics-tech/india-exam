<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">
  <meta name="description" content="MCQs available for UPSC, SSC, State Exams like Punjab, Haryana and other exams.">

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" crossorigin="anonymous"> -->

  <!-- Bootstrap CSS -->
  <link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('frontend/css/style.css?t='.time())}}">
  <link rel="stylesheet" href="{{asset('frontend/css/responsive.css?t='.time())}}">
  <style>
    * {
      user-select: none;
      /* supported by Chrome and Opera */
      -webkit-user-select: none;
      /* Safari */
      -khtml-user-select: none;
      /* Konqueror HTML */
      -moz-user-select: none;
      /* Firefox */
      -ms-user-select: none;
    }
  </style>
  @yield('css')
  <title>India Exam Junction</title>
  <link rel="icon" type="image/x-icon" href="{{asset('frontend/images/logophotoshop.jpg')}}">
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-2CKXC794CR"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-2CKXC794CR');
  </script>
  <!-- Required meta tags -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6588326529881449" crossorigin="anonymous"></script>
</head>

<body>
  @if(Route::is('online_quiz') || Route::is('home.data') || Route::is('search'))
  @include('frontend.layouts.header2')
  @else
  @include('frontend.layouts.header')
  @endif
  @yield('content')
  @include('frontend.layouts.footer')
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-3.4.1.min.js"> </script>
  <script src="{{asset('frontend/js/custom.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script>
    // take body to change the content
    // const body = document.getElementsByTagName('body');
    // // stop keyboard shortcuts
    // window.addEventListener("keydown", (event) => {

    //   if (event.ctrlKey && (event.key === "I" || event.key === "i")) {
    //     event.preventDefault();
    //     body[0].innerHTML = "sorry, you can't do this";
    //   }
    // });
    // // stop right click
    // document.addEventListener('contextmenu', function(e) {
    //   e.preventDefault();
    // });
  </script>
  <script>
    // document.addEventListener('contextmenu', event => event.preventDefault());

    // // Disable key down
    // document.onkeydown = disableSelectCopy;

    // // Disable mouse down
    // // document.onmousedown = dMDown;

    // // Disable click
    // document.onclick = dOClick;

    // function dMDown(e) {
    //   return false;
    // }

    // function dOClick() {
    //   return true;
    // }

    // function disableSelectCopy(e) {
    //   // current pressed key
    //   var pressedKey = String.fromCharCode(e.keyCode).toLowerCase();
    //   if ((e.ctrlKey && (pressedKey == "c" || pressedKey == "x" || pressedKey == "v" || pressedKey == "a" || pressedKey == "u")) || e.keyCode == 123) {
    //     return false;
    //   }

    // }
  </script>

  @yield('script')
</body>

</html>