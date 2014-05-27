<?php ?>

<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-9">
        Insert Name or Google Id:<BR>
        <input type="text" id="googleId" onChange="$('#addBookLink').attr('href', '/page/addbook/'+this.value)">
        <a href="" id="addBookLink">
            <button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-plus"></span> Add book
            </button>
            </a>
    </div>
</div>