<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>
                    Found <?php echo $searchResults[0]; ?> Books
                </h1>
            </div>
            <?php for ($i = 1;
                       $i < count($searchResults);
                       $i++): ?>
                <div class="col-xs-12 col-sm-4 text-center">
                    <div class="panel">
                        <div class="panel-heading">
                            <a href="/page/addbook/<?php echo $searchResults[$i]['google_id']; ?>">
                                <Img
                                    src="http://bks5.books.google.com/books?id=<?php echo $searchResults[$i]['google_id']; ?>&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api"
                                    class="img-rounded" style="min-height:180px;height:180px;">
                            </a>
                        </div>

                        <div class="panel-body">
                            <h4><?php echo $searchResults[$i]['name']; ?></h4>
                            <h6><?php echo $searchResults[$i]['author']; ?></h6>
                        </div>

                    </div>
                </div>
            <?php
            endfor;
            ?>
        </div>
    </div>
</div>