<?php
  if(!isset($_GET['s1'])){
    die;
  }
  require_once('../stuff/config.php');


  function echo_book_data($s1, $con){
    $data = get_book_data_s1($s1, $con);
    $name = $data['name'];
    $grade =  $data['grade'];
    $lang = $data['lang'];
    $categ =  $data['category'];
    $price = $data['price'];
    echo "
    <table class='dataTable display cell-border sortable'>
	<tr>
	<td>"._("НАЗВАНИЕ")."</td>
	<td><b>$name</b><br></b></td>
	</tr>
    <tr>
    <td>"._("ЯЗЫК")."</td>
    <td><b>$lang<br></b></td>
    </tr>
    <tr>
    <td>"._("КАТЕГОРИЯ")." </td>
    <td><b>$categ</b><br></td>
    </tr>
    <tr>
    <td>"._("КЛАСС")."</td>
    <td><b>$grade<br></b></td>
    </tr>
    <tr>
    <td>"._("ЦЕНА")."</td>
    <td><b>$price<br></b><br></td>
    </tr>
	</table>
    ";
  }
  

$s1 = $_GET['s1'];
addslashes($s1);
echo_book_data($s1, $con);


?>