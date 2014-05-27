<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>
                    <?php echo $title; ?>
                </h1>
            </div>
            <?php for ($i = 0;
                       $i < count($books);
                       $i++): ?>
                <div class="col-xs-12 col-sm-4 text-center">
                    <div class="panel">
                        <div class="panel-heading">
                            <a href="/page/book/<?php echo $books[$i]->id; ?>">
                                <Img
                                    src="http://bks5.books.google.com/books?id=<?php echo $books[$i]->google_id; ?>&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api"
                                    class="img-rounded" style="min-height:180px;height:180px;">
                            </a>

                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span
                                        class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/page/book/<?php echo $books[$i]->id; ?>">Book's Profile</a>
                                    </li>
                                    <li>
                                        <a onclick="alert('Broadcasting a book means posting to friends that you have it (maybe on FB, think about it...)')">Broadcast Book</a>
                                    </li>
                                    <li class="divider">
                                    </li>
                                    <li class="alert-danger">
                                        <a href="/page/removebook/<?php echo $books[$i]->id; ?>">Remove Book</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <h4><?php echo $books[$i]->name; ?></h4>
                            <h6><?php echo $books[$i]->author; ?></h6>
                        </div>

                    </div>
                </div>
            <?php
            endfor;
            ?>
        </div>
    </div>
</div>