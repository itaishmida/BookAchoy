<div class="container">
<div class="row">
<div class="col-xs-6">
    <div class="page-header">
        <h1>
            My Borrowings
            <small>Books I borrowed.</small>
        </h1>
    </div>
    <?php for ($i = 0;
               $i < count($loansToMe);
               $i++): ?>
        <div class="col-sm-12 col-md-6 text-center">
            <div class="panel">
                <div class="panel-heading">
                    <a href="/page/book/<?php echo $loansToMe[$i]->book_id; ?>">
                        <Img
                            src="http://bks5.books.google.com/books?id=<?php echo $loansToMe[$i]->google_id; ?>&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api"
                            class="img-rounded" style="min-height:180px;height:180px;">
                    </a>
                    <h4><?php echo $loansToMe[$i]->book_name; ?></h4>
                    <h6><?php echo $loansToMe[$i]->author; ?></h6>
                </div>
                <div class="panel-footer">
                    <h4><?php echo($loansToMe[$i]->due_date == null ? '<strong>Requesting</strong> from' : '<strong>Borrowed</strong> from') ?>
                        <a href="/page/bookshelf/<?php echo $loansToMe[$i]->friendId; ?>"><br/><br/><Img
                                border="0"
                                src="https://graph.facebook.com/<?php echo $loansToMe[$i]->friendFBid; ?>/picture?width=40&height=40"
                                width="30"
                                height="30"
                                class="img-rounded">
                        </a><?php echo $loansToMe[$i]->friendName ?>
                    </h4>

                    <?php if ($loansToMe[$i]->due_date == null) { ?>
                        <form action="/page/deleteLoan" method="post" name="cancelRequestFormNum<? php echo $i ?>">
                            <input type="hidden" value="<?php echo $loansToMe[$i]->google_id ?>" name="bookGoogleId">
                            <input type="hidden" value="<?php echo $loansToMe[$i]->friendId ?>" name="RequestingFriendId">
                            <input type="hidden" value="IBorrow" name="loanType">
                        </form>

                        <div class="btn-group">
                            <button type="submit"
                                    onclick="document.forms['cancelRequestFormNum<? php echo $i ?>'].submit();"
                                    class="btn btn-danger btn-sm pull-right">
                                <span class="glyphicon glyphicon-asterisk"></span>&nbsp;Cancel Request
                            </button>
                        </div>
                    <?php } else { ?>
                        <form action="/page/deleteLoan" method="post" name="completeLoanFormNum<? php echo $i ?>">
                            <input type="hidden" value="<?php echo $loansToMe[$i]->google_id ?>" name="bookGoogleId">
                            <input type="hidden" value="<?php echo $loansToMe[$i]->friendId ?>" name="RequestingFriendId">
                            <input type="hidden" value="IBorrow" name="loanType">
                        </form>

                        <div class="btn-group">
                            <button type="submit"
                                    onclick="document.forms['completeLoanFormNum<? php echo $i ?>'].submit();"
                                    class="btn btn-success btn-sm pull-right">
                                <span class="glyphicon glyphicon-asterisk"></span>&nbsp;Mark Book As
                                Returned
                            </button>
                        </div>
                    <?php } ?>

                    <h6>Request Date:<br/><?php echo $loansToMe[$i]->request_date ?></h6>
                    <h6>Loan
                        Date:<br/><?php echo($loansToMe[$i]->loan_date == null ? 'Loan request still pending.' : $loansToMe[$i]->loan_date) ?>
                    </h6>
                    <h6>Due
                        Date:<br/><?php echo($loansToMe[$i]->due_date == null ? 'Loan request still pending.' : $loansToMe[$i]->due_date) ?>
                    </h6>
                </div>

            </div>
            <ul class="nav nav-list">
                <li class="divider"></li>
            </ul>
        </div>
    <?php
    endfor;
    ?>
</div>
<div class="col-xs-6">
    <div class="page-header">
        <h1>
            My Loans
            <small>Books borrowed from me.</small>
        </h1>
    </div>
    <?php for ($i = 0;
               $i < count($loansFromMe);
               $i++): ?>
        <div class="col-sm-12 col-md-6 text-center">
            <div class="panel">
                <div class="panel-heading">
                    <a href="/page/book/<?php echo $loansFromMe[$i]->book_id; ?>">
                        <Img
                            src="http://bks5.books.google.com/books?id=<?php echo $loansFromMe[$i]->google_id; ?>&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api"
                            class="img-rounded" style="min-height:180px;height:180px;">
                    </a>
                    <h4><?php echo $loansFromMe[$i]->book_name; ?></h4>
                    <h6><?php echo $loansFromMe[$i]->author; ?></h6>
                </div>
                <div class="panel-footer">
                    <h4><a href="/page/bookshelf/<?php echo $loansFromMe[$i]->userId; ?>"><Img
                                border="0"
                                src="https://graph.facebook.com/<?php echo $loansFromMe[$i]->userFBid; ?>/picture?width=40&height=40"
                                width="30"
                                height="30"
                                class="img-rounded">
                        </a><?php echo $loansFromMe[$i]->userName ?><br/><br/>
                        <?php echo($loansFromMe[$i]->due_date == null ? '<strong>is requesting </strong> from me.' : '<strong>is borrowing</strong> from me.') ?>
                    </h4>
                    <?php if ($loansFromMe[$i]->due_date == null) { ?>
                        <form action="/page/confirmLoan" method="post" name="confirmLoanFormNum<? php echo $i ?>">
                            <input type="hidden" value="<?php echo $loansFromMe[$i]->google_id ?>" name="bookGoogleId">
                            <input type="hidden" value="<?php echo $loansFromMe[$i]->userId ?>"
                                   name="RequestingFriendId">
                        </form>

                        <form action="/page/deleteLoan" method="post" name="denyLoanFormNum<? php echo $i ?>">
                            <input type="hidden" value="<?php echo $loansFromMe[$i]->google_id ?>" name="bookGoogleId">
                            <input type="hidden" value="<?php echo $loansFromMe[$i]->userId ?>"
                                   name="RequestingFriendId">
                            <input type="hidden" value="ILend" name="loanType">

                        </form>

                        <div class="btn-group">
                            <button type="submit"
                                    onclick="document.forms['confirmLoanFormNum<? php echo $i ?>'].submit();"
                                    class="btn btn-success btn-sm pull-left">
                                <span class="glyphicon glyphicon-asterisk"></span>&nbsp;Confirm Loan
                            </button>
                            <button type="submit"
                                    onclick="document.forms['denyLoanFormNum<? php echo $i ?>'].submit();"
                                    class="btn btn-danger btn-sm pull-right">
                                <span class="glyphicon glyphicon-asterisk"></span>&nbsp;Deny Loan
                            </button>
                        </div>
                    <?php } else { ?>
                        <form action="/page/deleteLoan" method="post" name="markReturnedFormNum<? php echo $i ?>">
                            <input type="hidden" value="<?php echo $loansFromMe[$i]->google_id ?>" name="bookGoogleId">
                            <input type="hidden" value="<?php echo $loansFromMe[$i]->userId ?>"
                                   name="RequestingFriendId">
                            <input type="hidden" value="ILend" name="loanType">

                        </form>

                        <div class="btn-group">
                            <button type="submit"
                                    onclick="document.forms['markReturnedFormNum<? php echo $i ?>'].submit();"
                                    class="btn btn-success btn-sm pull-right">
                                <span class="glyphicon glyphicon-asterisk"></span>&nbsp;Mark Book As Returned
                            </button>
                        </div>
                    <?php } ?>
                    <h6>Request Date:<br/><?php echo $loansFromMe[$i]->request_date ?></h6>
                    <h6>Loan
                        Date:<br/><?php echo($loansFromMe[$i]->loan_date == null ? 'Loan request still pending.' : $loansFromMe[$i]->loan_date) ?>
                    </h6>
                    <h6>Due
                        Date:<br/><?php echo($loansFromMe[$i]->due_date == null ? 'Loan request still pending.' : $loansFromMe[$i]->due_date) ?>
                    </h6>
                </div>

            </div>
            <ul class="nav nav-list">
                <li class="divider"></li>
            </ul>
        </div>
    <?php
    endfor;
    ?>
</div>
</div>
</div>