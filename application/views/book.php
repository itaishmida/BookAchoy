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
                    <a href="http://books.google.co.il/books?id=<?php echo $book["google_id"]; ?>" target="_blank">
                        <img src="http://bks5.books.google.com/books?id=<?php echo $book["google_id"]; ?>&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api" class="img-responsive">
                    </a>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-9">
                            <H1><?php echo $book["name"]; ?> <small><?php echo $book["author"]; ?></small></H1>
                        </div>
                        <div class="col-md-3">
                            <?php if ($isOwnedByCurrentUser): ?>
                                <button data-toggle="dropdown" class="btn btn-default btn-lg dropdown-toggle">
                                    <span class="glyphicon glyphicon-ok"></span> &nbsp;
                                    I have this book <span
                                        class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li class="alert-danger">
                                        <a href="/page/removebook/<?php echo $book['id']; ?>">No, I don't</a>
                                    </li>
                                </ul>
                            <?php else: ?>
                                <a href="/page/addbook/<?php echo $book["google_id"]; ?>">
                                    <button type="button" class="btn btn-default btn-lg">
                                        <span class="glyphicon glyphicon-plus"></span> Add to my bookshelf
                                    </button>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>

                    <BR><BR>
                    <H3>Review 1 <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span></H3>
There was a time in my life when I couldn’t get enough of reading Dostoevsky. Maybe because his books made me think so deeply about being human and how we choose to live our lives. I began with Crime and Punishment, probably the work he is best known for.

                        What I remember is being fascinated by Dostoevsky’s brilliant understanding of human nature. I remember thinking what a deep study this book was; an incredible examination of a man who commits murder and how he is “punished” for it.
                    <BR><BR>
                    <H3>Review 2 <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span></H3>
There was a time in my life when I couldn’t get enough of reading Dostoevsky. Maybe because his books made me think so deeply about being human and how we choose to live our lives. I began with Crime and Punishment, probably the work he is best known for.


                </div>

            </div>
        </div>