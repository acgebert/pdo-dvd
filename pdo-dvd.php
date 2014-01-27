<html>
<head>
    <style>
    td {background: #97FFDA; }
    td:nth-child(2) { background: #9598E8; }
    td:nth-child(3) { background: #FFA3D0; }
    td:nth-child(4) { background:#E8FF97; }
    </style>
</head>
<body>
<?php
$host ='itp460.usc.edu';
$dbname = 'dvd';
$user ='student';
$pass ='ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$dvd1 = $_GET['dvd'];
echo "<strong>You searched for:</strong> ";
echo $dvd1 . ".";
echo "<br/>". "If you search returned zero results, then ". "<a href='dvdsearch.php'>"."click here</a>. <br/>";

$like = '%'.$dvd1.'%';



$sql = "
SELECT
    title, rating_id, genre_id, format_id, format, rating, genre
FROM
    dvd_titles
        INNER JOIN
    ratings ON dvd_titles.rating_id = ratings.id

        INNER JOIN
    genres ON dvd_titles.genre_id = genres.id

        INNER JOIN
    formats ON dvd_titles.format_id = formats.id


WHERE title LIKE '$like'
";
$two = null;
$one=null;
$statement = $pdo->prepare($sql);
$statement->bindParam(1, $like); //stanitizes the info to be a ? prevents injection
$statement->execute();
$dvd2 = $statement->fetchAll(PDO::FETCH_OBJ);




   // if ($sql->fetchColumn() > 0) {


       // $sql = "
//SELECT
 //   title, rating_id, genre_id, format_id, format, rating, genre
//FROM
 //   dvd_titles
 //       INNER JOIN
  //  ratings ON dvd_titles.rating_id = ratings.id

   //     INNER JOIN
   // genres ON dvd_titles.genre_id = genres.id

  //      INNER JOIN
  ///  formats ON dvd_titles.format_id = formats.id


//WHERE title LIKE '$like'
//";







//var_dump($dvd2);
?>
<table>
    <strong><tr><th>Title</th><th>Genre</th><th>Format</th><th>Rating</th></tr></strong>
<?php foreach ($dvd2 as $dvd1) : ?>
<tr>
       <td> <?php
    echo $dvd1->title
   ?></td>

        <td><?php
    echo $dvd1->genre?></td>

   <td> <?php echo $dvd1->format?></td>

   <td> <?php echo $dvd1->rating?>
       </td></tr>
<?php endforeach; ?>

    </td></tr>
    </table>
    <?php
    //} else {
  // echo "You returned zero results. Please return to the search page.";
   // echo "<br />";}

?>
</body>
</html>


/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/21/14
 * Time: 7:33 PM
 */ 