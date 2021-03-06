<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header col-xs-9">
                <h1>
                    <?php echo $title; ?>
                </h1>
            </div>

            <?php if (isset($invite) && $invite): ?>
                <div class="col-xs-3">
                    <a href="#" onclick="FacebookInviteFriends();">
                        <button type="button" class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-plus"></span> Invite Friends
                        </button>
                    </a>
                </div>
            <?php endif; ?>

            <?php for ($j = 0;
                       $j < count($friends);
                       $j++): ?>
                <div class="col-xs-12 col-sm-4 text-center">
                    <div class="panel">
                        <div class="panel-heading">
                            <a href="/page/bookshelf/<?php echo $friends[$j]->id; ?>">
                                <Img
                                    src="https://graph.facebook.com/<?php echo $friends[$j]->fbid; ?>/picture?width=150&height=150"
                                    class="img-rounded" style="min-height:130px;height:130px;">
                            </a>

                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span
                                        class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/page/bookshelf/<?php echo $friends[$j]->id; ?>">Friend's bookshelf</a>
                                    </li>
                                    <?php if (isset($bookId)): ?>
                                        <li class="alert-success">
                                            <form action="/page/loanBook" method="post" name="loanFormNum<?php echo $j; ?>">
                                                <input type="hidden" value="<?php echo $bookId; ?>" name="bookGoogleId">
                                                <input type="hidden" value="<?php echo $friends[$j]->id; ?>" name="ownerUserId">
                                                <button type="submit" class="btn btn-default btn-sm">
                                                    <span class="glyphicon glyphicon-asterisk"></span>&nbsp;Loan Book
                                                </button>
                                            </form>
                                        </li>
                                    <?php endif; ?>
                                    <li> <!--link to facebook message with link to the book. there is some problem with the book page url-->
                                        <!--a href="https://www.facebook.com/dialog/send?app_id=636197546460681&to=<?php echo $friends[$j]->fbid; ?>&link=http://bookachoy.com<?php echo $_SERVER['REQUEST_URI']; ?>&redirect_uri=http://bookachoy.com/" target=_blank">Send a message</a-->
                                        <a href="https://www.facebook.com/dialog/send?app_id=636197546460681&to=<?php echo $friends[$j]->fbid; ?>&link=http://bookachoy.com&redirect_uri=http://bookachoy.com/" target=_blank">Send a message</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://www.facebook.com/profile.php?id=<?php echo $friends[$j]->fbid; ?>">Friend's Facebook Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h4><?php echo $friends[$j]->name; ?></h4>
                            <h6><?php echo $friends[$j]->join_date; ?></h6>
                        </div>

                    </div>
                </div>
            <?php
            endfor;
            ?>
        </div>
    </div>
</div>


<?php if (isset($invite) && $invite): ?>
    <script src="https://connect.facebook.net/en_US/all.js"></script>
    <script>
        FB.init({
            appId:'636197546460681',
            cookie:true,
            status:true,
            xfbml:true
        });

        function FacebookInviteFriends()
        {
            FB.ui({
                method: 'apprequests',
                message: 'Your Message diaolog'
            });
        }
    </script>
<?php endif; ?>