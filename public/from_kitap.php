<?php
	require_once("../stuff/config.php");
	permission("main");
?>
<style>
img.ikitap:hover{
	box-shadow: 0 0 10px rgba(0,0,0,9);
}
a.no_effect{
	color:inherit;
	background:inherit;
}
</style>
<?php
function get_founds_ikitap($book_name){

  $url = 'http://ikitap.ru/search.php';

  $data = array('entry' => $book_name);

  $options = array(

    'http' => array(

      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",

      'method'  => 'POST',

      'content' => http_build_query($data),

    ),

  );

  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $result = str_replace('src="', 'class = "ikitap" src="http://ikitap.ru/', $result);
  $result = str_replace('<a', '<a class = "ikitap"', $result);
  $result = "<center>  $result </center>";
  echo $result;

}
// end of funcs
$book = get_book_data_s1($_GET['s1'], $con); 
$nameb = $book['name'];
$categb = $book['category'];
$gradeb = $book['grade'];
$book = "
    <table class='dataTable display cell-border'>
	<tr>
	<td>"._("НАЗВАНИЕ")."td>
	<td><b>$nameb</b><br></b></td>
	</tr>
    <tr>
    <td>"._("КАТЕГОРИЯ")." </td>
    <td><b>$categb</b><br></td>
    </tr>
    <tr>
    <td>"._("КЛАСС")."</td>
    <td><b>$gradeb<br></b></td>
    </tr>
	</table>
    ";
$s1 = $_GET['s1'];
echo "
 <center class = 'header'> $nameb  </center><br> $book <br>
";
get_founds_ikitap($_GET['name']);	
?>

<footer style = "background:#E1D9FA">
<center>
<hr>
Поиск<br>
<a class = "no_effect" href = "http://ikitap.ru">
<img src = "http://ikitap.ru/img/logo.png"/> <br> </a> iKitap
</center>
</footer>
</html>