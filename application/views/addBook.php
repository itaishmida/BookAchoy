<?php ?>

<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-9">
        Search for a book:<BR>
        <input type="text" id="searchTerm" onChange="$('#addBookLink').attr('href', '/page/searchbook/'+this.value)">
        <a href="" id="addBookLink">
            <button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-plus"></span> Add book
            </button>
            </a>
    </div>
</div>