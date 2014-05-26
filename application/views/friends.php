<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>
                    My Friends
                </h1>
            </div>
            <?php for ($j = 0;
                       $j < count($friends);
                       $j++): ?>
                <div class="col-xs-12 col-sm-4 text-center">
                    <div class="panel">
                        <div class="panel-heading">
                            <Img
                                src="http://graph.facebook.com/<?php echo $friends[$j]->fbid; ?>/picture?width=150&height=150"
                                class="img-rounded" style="min-height:130px;height:130px;">

                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span
                                        class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/page/profile/<?php echo $friends[$j]->id; ?>">Friends's BookAchoy Profile</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://www.facebook.com/profile.php?id=<?php echo $friends[$j]->fbid; ?>">Friends's Facebook Profile</a>
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