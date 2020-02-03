
<html>
    <head>
        <title>C-project</title>
        <!-- This is the bootstrap links--->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!--end of Boostrap links-->
    </head>
    <body>
        <h1 class="display1 text-center text-dark">Check page Title and H1 heading of any link</h1>
        <div class="container mt-5">
            <form action="index_1.php" method="POST">

                <input type="url" name="url" placeholder="Enter Url and check title and headings" class="form-control w-100 text-center" required="" />
                <br>
                <input type="submit" name="submit" class="btn btn-success" style="margin-left: 500px;">

            </form>
        </div>
    </body>

</html>


<?php
if (isset($_POST['submit'])) {// submit btn

    $link = $_POST['url']; //text box links
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $html = curl_exec($ch);
    curl_close($ch);

    $DOM = new DOMDocument();
    libxml_use_internal_errors(true);
    $DOM->loadHTML(file_get_contents($link));

//$DOM->encoding='UTF-8';// change for https only
    $element = $DOM->getElementsByTagName('title'); // title tag
    $element1 = $DOM->getElementsByTagName('h1'); //h1 heading
    $element2 = $DOM->getElementsByTagName('h2');
    $element3 = $DOM->getElementsByTagName('h3');
    $element4 = $DOM->getElementsByTagName('h4');
    $element5 = $DOM->getElementsByTagName('h5');
    $element6 = $DOM->getElementsByTagName('h6');
    $meta = $DOM->getElementsByTagName('img');
    $items = array();
    foreach($meta as $metatri){
        
       $items[] = $metatri->getAttribute('alt'); 
      
    }    
    $len=count($items);


$links= $DOM->getElementsByTagName('link');
    $items_links = array();
    foreach($links as $metatri){
        
       $items_links[] = $metatri->getAttribute('href'); 
      
    }
    $len_links=count($items);
    print_r($items_links);
    
    for ($i = 0; $i < $len_links; $i++) {

        echo "<div class='container bg-light w-100'><h3 class='display3 text-center'>".$i." Links rel Tags :-  " . $items_links[$i] . "</h3></div>";
    }
    
    for ($i = 0; $i < $element->length; $i++) {

        echo "<div class='container bg-light w-100'><h3 class='display3 text-center'>Title of the page :-  " . $element->item(0)->nodeValue . "</h3></div>";
    }

    for ($i = 0; $i < $element1->length; $i++) {
        $a = $i + 1;
        echo "<div class='container bg-secondary text-light'><h4 class='display4'>Heading " . $a . ":-" . $element1->item($i)->nodeValue . "<br><br></h4></div>";
        //nodeValue. is used for the  different values for different node type ***code red new concept
    }

    for ($i = 0; $i < $element2->length; $i++) {

        echo "<div class='container bg-light w-100'><h3 class='display3 text-center'>Heading 2" .$i." :-  " . $element2->item(0)->nodeValue . "</h3></div>";
    }

    for ($i = 0; $i < $element3->length; $i++) {

        echo "<div class='container bg-light w-100'><h3 class='display3 text-center'>Heading 3".$i." :-  " . $element3->item(0)->nodeValue . "</h3></div>";
    }

    for ($i = 0; $i < $element4->length; $i++) {

        echo "<div class='container bg-light w-100'><h3 class='display3 text-center'>Heading 4".$i." :-  " . $element4->item(0)->nodeValue . "</h3></div>";
    }

    for ($i = 0; $i < $element5->length; $i++) {

        echo "<div class='container bg-light w-100'><h3 class='display3 text-center'>Heading 5".$i." :-  " . $element5->item(0)->nodeValue . "</h3></div>";
    }

    for ($i = 0; $i < $element6->length; $i++) {

        echo "<div class='container bg-light w-100'><h3 class='display3 text-center'>Heading 6".$i." :-  " . $element6->item(0)->nodeValue . "</h3></div>";
    }
    
    for ($i = 0; $i < $len; $i++) {
        echo ' <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Images '.$i.'
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">'
        . $items[$i].'
  </div>
</div>';
        
        //echo "<div class='container bg-light w-100'><h3 class='display3 text-center'>Images Alt Info :-  " . $element6->item(0)->nodeValue . "</h3></div>";
    }
}
?>