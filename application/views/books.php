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
                <H2><?php echo $title; ?></H2>

<?php           for ($i = 0; $i < count($books); $i++): ?>
                    <Div class="col-md-2">
                        <a href="../book/<?php echo $books[$i]->id; ?>" class="thumbnail">
                            <Img src="https://camo.githubusercontent.com/a97caaf3cb42b9575306f88b4530cfae54d86737/687474703a2f2f69636f6e732e69636f6e617263686976652e636f6d2f69636f6e732f726f62696e77656174686572616c6c2f6c6962726172792f3132382f626f6f6b732d69636f6e2e706e67" height="200">
                            <Div class="caption" style="text-align: right">
                                <H4><?php echo $books[$i]->name . " / " . $books[$i]->author; ?></H4>
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
