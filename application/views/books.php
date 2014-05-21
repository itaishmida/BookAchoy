<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 24/04/14
 * Time: 21:50
 */
?>
    <Div class="row">
        <Div class="col-md-1"></Div>
        <Div class="col-md-10" style="border: 1">
            <Div class="row">
                <H2>My Books</H2>

<?php           for ($i = 0; $i < count($books); $i++): ?>
                    <Div class="col-md-2">
<<<<<<< HEAD
                        <a href="/page/book/<?php echo $books[$i]->id; ?>" class="thumbnail">
                            <Img src="http://bks5.books.google.com/books?id=<?php echo $books[$i]->google_id; ?>&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api" height="200">
=======
                        <a href="book?id=<?php echo $i ?>" class="thumbnail">
                            <Img src="<?php echo $books[$i]["picUrl"]; ?>&zoom=1" height="200">
>>>>>>> 851b66210b5d5ac425ef8bbc5eb04bd0d3fe1a89
                            <Div class="caption" style="text-align: right">
                                <H4><?php echo $books[$i]["name"] . " / " . $books[$i]["author"]; ?></H4>
                            </Div>
                        </a>
                    </Div>
<?php
                    if ($i%6==5)
                        echo "</Div>";
                endfor; ?>
            </Div>
        </Div>
        <Div class="col-md-1"></Div>
    </Div>
