<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 12/05/14
 * Time: 22:12
 */
?>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="http://books.google.co.il/books?id=<?php echo $book->google_id; ?>" target="_blank">
                        <img src="http://bks5.books.google.com/books?id=<?php echo $book->google_id; ?>&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api" class="img-responsive">
                    </a>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-9">
                            <H1><?php echo $book->name; ?> <small><?php echo $book->author; ?></small></H1>
                        </div>
                        <div class="col-md-3">
                            <?php if ($isOwnedByCurrentUser): ?>
                                <button data-toggle="dropdown" class="btn btn-default btn-lg dropdown-toggle">
                                    <span class="glyphicon glyphicon-ok"></span> &nbsp;
                                    I have this book <span
                                        class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li class="alert-danger">
                                        <a href="/page/removebook/<?php echo $book->id; ?>">No, I don't</a>
                                    </li>
                                </ul>
                            <?php else: ?>
                                <a href="/page/addbook/<?php echo $book->google_id; ?>">
                                    <button type="button" class="btn btn-default btn-lg">
                                        <span class="glyphicon glyphicon-plus"></span> Add to my bookshelf
                                    </button>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>

                    <!----------------- Reviews ----------------------->
                    <BR><BR>



                    <?php for ($i=0; $i<count($reviews); $i++): ?>
                        <H3>
                        <?php for ($j=0; $j<$reviews[$i]->rating; $j++): ?>
                            <span class="glyphicon glyphicon-star"></span>
                        <?php endfor; ?>
                        </H3>
                        <blockquote>
                            <?php echo $reviews[$i]->review_text; ?>
                            <footer><a href="/page/bookshelf/<?php echo $reviews[$i]->id; ?>"><?php echo $reviews[$i]->name; ?></a>
                        </blockquote>
                        <BR><BR>
                    <?php endfor; ?>

                    <Form action="/page/reviewBook" method="post" id="review_form" style="display: none">
                        <H3>Review :
                            <span class="glyphicon glyphicon-star-empty" onClick="rank(1)" id="rank1"></span>
                            <span class="glyphicon glyphicon-star-empty" onClick="rank(2)" id="rank2"></span>
                            <span class="glyphicon glyphicon-star-empty" onClick="rank(3)" id="rank3"></span>
                            <span class="glyphicon glyphicon-star-empty" onClick="rank(4)" id="rank4"></span>
                            <span class="glyphicon glyphicon-star-empty" onClick="rank(5)" id="rank5"></span></H3>
                        <input type="hidden" name="rank" id="rank">
                        <input type="hidden" name="book" value="<?php echo $book->id; ?>">
                        <textarea name="review" rows="4" cols="80" style="vertical-align:bottom"></textarea>
                        <span>
                            <button type="submit" class="btn btn-default btn-sm">Send</button>
                        </span>
                    </Form>

                    <button class="btn btn-default btn-lg" onclick="$('#review_form').show(); $(this).hide()">Write a review</button>

                </div>

            </div>
        </div>

<Script>
    function rank(grade) {
        $('#rank').val(grade);
        for (i=1; i<=grade; i++) {
            $('#rank'+i).removeClass('glyphicon-star-empty');
            $('#rank'+i).addClass('glyphicon-star');
        }
        for (i=grade+1; i<=5; i++) {
            $('#rank'+i).removeClass('glyphicon-star');
            $('#rank'+i).addClass('glyphicon-star-empty');
        }
    }
</Script>