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
                        <a href="book?id=<?php echo $i ?>" class="thumbnail">
                            <Img src="<?php echo $books[$i]["picUrl"]; ?>&zoom=1" height="200">
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
