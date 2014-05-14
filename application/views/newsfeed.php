<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <h2>
                News Feed
            </h2>

            <h3>New Books</h3>

            <h3>New Friends</h3>

            <div class="table-responsive">
                <table class="table table-condensed">
                    <tr class="success">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Account Status</td>
                        <td>Join Date</td>
                    </tr>
                    <?php
                    //$this->db->where('name = "Mor Test2"');
                    $query = $this->db->get('user');
                    $numOfFriends = 20;
                    $query = $this->db->query('SELECT * FROM user ORDER BY join_date DESC limit ' . $numOfFriends);
                    foreach ($query->result() as $row) {
                        echo '<tr class="activesuccess">';
                        echo '<td>' . $row->id . '</td>';
                        echo '<td>' . $row->name . '</td>';
                        echo '<td>' . $row->email . '</td>';
                        echo '<td ';
                        if ($row->acct_status == 0)
                            echo "class='active'>Active";
                        elseif ($row->acct_status == 1)
                            echo "class='info'>Inactive";
                        else
                            echo "class='danger'>Banned";
                        echo '</td>';
                        echo '<td>' . $row->join_date . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>