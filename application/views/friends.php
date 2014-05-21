<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 18/04/14
 * Time: 15:13
 */
        $numOfFriends = count($friends);
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title>demo</title>
</head>
<body>




<!-- *********************** Friends list ************************************ -->

<?php
    if ($friends!="") { ?>
        <Div class="row">
            <Div class="col-md-1"></Div>
            <Div class="col-md-10" style="background-color: lightgray">
                <H2><?php echo $title; ?>
                </H2>

<?php           $start = rand(0, count($friends));
                for ($i = 0; $i<$numOfFriends; $i++) {
                    $j = ($start + $i) % count($friends);
                     ?>
                    <Div class="col-md-2">
                        <a href="/page/bookshelf/<?php echo $friends[$j]->id; ?>" class="thumbnail">
                                <Img src="http://graph.facebook.com/<?php echo $friends[$j]->fbid; ?>/picture?width=150&height=150" width="150" height="150">
                                <div class="caption">
                                    <H5><?php echo $friends[$j]->name; ?></H5>
                                    <span class="glyphicon glyphicon-envelope">
                                </div>
                        </a>
                    </Div>
<?php           } ?>
            </Div>
            <Div class="col-md-1"></Div>
        </Div>
<?php
    }
?>

</body>
</html>