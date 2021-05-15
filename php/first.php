<?php
  header("Access-Control-Allow-Origin: *");

  $colors_classes = array(
    "yellow" => "btn-warning",
    "red" => "btn-danger",
    "green" => "btn-success",
    "blue" => "btn-primary",
  );

  function get_color_class($path) {
    global $colors_classes;
    $color = $_GET["color"];
    return $color == $path ? $colors_classes[$color] : "";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
</head>
<body>
  <div class="container text-center mt-3">
    <a class="btn <?php echo get_color_class("yellow") ?>" href="?color=yellow">Yellow</a>
    <a class="btn <?php echo get_color_class("red") ?>" href="?color=red">Red</a>
    <a class="btn <?php echo get_color_class("green") ?>" href="?color=green">Green</a>
    <a class="btn <?php echo get_color_class("blue") ?>" href="?color=blue">Blue</a>
  </div>
</body>
</html>