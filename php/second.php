<?php
define("SIZE", 5);

function filter_out($val)
{
  if (is_numeric($val)) {
    return !is_int($val + 0);
  }

  return $val != "";
}

function sort_as_strings(&$arr)
{
  usort($arr, function ($a, $b) {
    return strcmp($a, $b);
  });
}

function round_two($number)
{
  return round($number, 2);
}

function transform_value($value)
{
  return is_numeric($value) ? round_two($value) : trim(mb_strtoupper($value));
}

$method = $_SERVER["REQUEST_METHOD"] === "POST" ? $_POST : $_GET;

$matrix = array_map(function ($input) {
  return $input != "" ? explode(",", $input) : array();
}, $method);


$transformed_matrix = array();
foreach ($matrix as $key => $arr) {
  $transformed_arr = array_map("transform_value", array_filter($arr, "filter_out"));
  sort_as_strings($transformed_arr);

  $transformed_matrix[$key] = $transformed_arr;
}

function create_table($matrix)
{
  echo "<table class=\"table table-striped\">";
  echo "<tr>";
  foreach (range(1, count($matrix)) as $id) {
    echo "<th>Array $id</th>";
  }
  echo "</tr>";

  foreach (range(0, count(max($matrix)) - 1) as $id) {
    echo "<tr>";
    foreach ($matrix as $arr) {
      echo "<td>$arr[$id]</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
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
  <div class="container">
    <h1 class="text-center">Lab #1</h1>

    <form action="/second.php" method="POST">
      <?php
      foreach (range(0, SIZE - 1) as $id) {
        echo
          "<div class=\"form-group\">
            <input class=\"form-control\" name=$id placeholder=\"#$id\"/>
          </div>";
      }
      ?>

      <button class="btn btn-primary btn-block">Send</button>
    </form>

    <?php

    if (count($matrix) > 0) {
      echo
        "<div class=\"row mt-4\">
          <div class=\"col-lg-6\">
            <h2 class=\"text-center\">Before</h2>";
      create_table($matrix);
      echo "</div>";

      echo "<div class=\"col-lg-6\">
              <h2 class=\"text-center\">After</h2>";
      create_table($transformed_matrix);
      echo "</div>";

      echo "</div>";
    }
    ?>
</body>

</html>