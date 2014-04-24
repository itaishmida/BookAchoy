<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 18/04/14
 * Time: 15:13
 */

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title>demo</title>
</head>
<body>
<?php //print_r($url); ?>
<?php //print_r($friends); ?>
<BR><BR>

<?php if ($url!=""): ?>
    <a href="<?php echo $url; ?>">Click here to login</a><BR>
<?php endif ?>



<?php
    if ($friends!="") { ?>
        <Div class="row">
            <Div class="col-md-1"></Div>
            <Div class="col-md-10" style="background-color: lightgray">
                <H2>My Friends</H2>

<?php           for ($i = 0; $i < 6 /*count($friends)*/; $i++): ?>
                    <Div class="col-md-2">
                        <a href="https://www.facebook.com/<?php echo $friends[$i]["id"]; ?>" class="thumbnail">
                                <Img src="http://graph.facebook.com/<?php echo $friends[$i]["id"]; ?>/picture?width=150&height=150" width="150" height="150">
                                <div class="caption">
                                    <H5><?php echo $friends[$i]["name"]; ?></H5>
                                </div>
                        </a>
                    </Div>
<?php           endfor; ?>
            </Div>
        </Div>
<?php
    }
?>

</body>
</html>