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
        <Div class="col-md-10">
        <H2>My Books</H2>

<?php   for ($i = 0; $i < count($books); $i++): ?>
            <Div class="col-xs-6 col-md-2">
                <a href="http://books.google.co.il/books?id=<?php echo $books[$i]["id"]; ?>" class="thumbnail">
                    <Img src="<?php echo $books[$i]["url"]; ?>" height="200">
                    <div class="caption" style="text-align: right">
                        <H4><?php echo $books[$i]["name"] . " / " . $books[$i]["author"]; ?></H4>
                    </div>
                </a>
            </Div>
<?php   endfor; ?>
        </Div>
    </Div>
