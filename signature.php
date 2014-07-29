<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Require a Drawn Signature · Signature Pad</title>
  <style>
    body { font: normal 100.01%/1.375 "Helvetica Neue",Helvetica,Arial,sans-serif; }
  </style>
  <link href="css/jquery.signaturepad.css" rel="stylesheet">
  <!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->
  <script src="js/vendor/jquery.js"></script>
</head>
<body>
  <form method="post" action="" class="sigPad">
    <label for="name">Print your name</label>
    <input type="text" name="name" id="name" class="name">
    <p class="drawItDesc">Draw your signature</p>
    <ul class="sigNav">
      <li class="drawIt"><a href="#draw-it" >Draw It</a></li>
      <li class="clearButton"><a href="#clear">Clear</a></li>
    </ul>
    <div class="sig sigWrapper">
      <div class="typed"></div>
      <canvas class="pad" width="198" height="55"></canvas>
      <input type="hidden" name="output" class="output">
    </div>
    <button type="submit">I accept the terms of this agreement.</button>
  </form>

  <script src="js/jquery.signaturepad.js"></script>
  <script>
    $(document).ready(function() {
      $('.sigPad').signaturePad({drawOnly:true});
    });
  </script>
  <script src="js/json2.min.js"></script>
</body>
