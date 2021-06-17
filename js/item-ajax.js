$( document ).ready(function() {

var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageData();

/* Manage Data List */

function manageData() {
    $.ajax({
        dataType: 'json',
        url: url+'api/getData.php',
        data: {page:page}
    }).done(function(data){
    	total_page = Math.ceil(data.total/10);
    	current_page = page;
    	$('#pagination').twbsPagination({
	        totalPages: total_page,
	        visiblePages: current_page,
	        onPageClick: function (event, pageL) {
	        	page = pageL;
                if(is_ajax_fire != 0){
	        	  getPageData();
                }
	        }
	    });

    	manageRow(data.data);
        is_ajax_fire = 1;
    });
}


/* Get Page Data*/

function getPageData() {
	$.ajax({
    	dataType: 'json',
    	url: url+'api/getData.php',
    	data: {page:page}
	}).done(function(data){
		manageRow(data.data);
	});
}

/* Add new Item table row */

function manageRow(data) {
	var	rows = '';
	$.each( JSON.parse(data), function( key, value ) {
	  	rows = rows + '<tr>';
	  	rows = rows + '<td>'+value.transaction+'</td>';
	  	rows = rows + '<td>Rp.'+value.amount+'</td>';
        rows = rows + '<td>'+value.date+'</td>';
        rows = rows + '<td>'+value.category+'</td>';
        rows = rows + '<td>'+value.inout+'</td>';
	  	rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
	  	rows = rows + '</tr>';
	});

	$("tbody").html(rows);
}


/* Create new Item */

$(".crud-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-item").find("form").attr("action");
    var transaction = $("#create-item").find("input[name='transaction']").val();
    var amount      = $("#create-item").find("input[name='amount']").val();
    var date        = $("#create-item").find("input[name='date']").val();
    var category    = $("#create-item").find("select[name='category']").val();
    var inout       = $("#create-item").find("select[name='inout']").val();
//    var sutradara   = $("#create-item").find("textarea[name='sutradara']").val();
//    var aktor       = $("#create-item").find("textarea[name='aktor']").val();

    if(transaction != ''){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + form_action,
            data:{transaction:transaction, amount:amount, date:date, category:category, inout:inout}
        }).done(function(data){
            $("#create-item").find("input[name='transaction']").val('');
            $("#create-item").find("input[name='amount']").val('');
            $("#create-item").find("input[name='date']").val('');
            $("#create-item").find("select[name='category']").val('');
            // $("#create-item").find("form-control[id='inout']").val('');
            $("#create-item").find("select[name='inout']").val('');

            getPageData();
            $(".modal").modal('hide');
            toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
        });
    }else{
        confirm('Please Fill Transaction Name')
    }
});

/* Remove Item */

$("body").on("click",".remove-item",function(){
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url + 'api/delete.php',
        data:{id:id}
    }).done(function(data){
        c_obj.remove();
        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        getPageData();
    });
});

/* Edit Item */

$("body").on("click",".edit-item",function(){
    var id          = $(this).parent("td").data('id');
    var transaction = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var amount      = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
    var date        = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var category    = $(this).parent("td").prev("td").prev("td").text();
    var inout       = $(this).parent("td").prev("td").text();

    $("#edit-item").find("input[name='transaction']").val(transaction);
    $("#edit-item").find("input[name='amount']").val(amount);
    $("#edit-item").find("input[name='date']").val(date);
    $("#edit-item").find("select[name='category']").val(category);
    $("#edit-item").find("select[name='inout']").val(inout);
    $("#edit-item").find(".edit-id").val(id);
});

/* Updated New Item */

$(".crud-submit-edit").click(function(e){
    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    var id          = $("#edit-item").find(".edit-id").val();
    var transaction = $("#edit-item").find("input[name='transaction']").val();
    var amount      = $("#edit-item").find("input[name='amount']").val();
    var date        = $("#edit-item").find("input[name='date']").val();
    var category    = $("#edit-item").find("select[name='category']").val();
    var inout       = $("#edit-item").find("select[name='inout']").val();
    // var sutradara = $("#edit-item").find("textarea[name='sutradara']").val();
    // var aktor = $("#edit-item").find("textarea[name='aktor']").val();

    if(transaction != ''){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + form_action,
            data:{id:id, transaction:transaction, amount:amount, date:date, category:category, inout:inout}
        }).done(function(data){
            getPageData();
            $(".modal").modal('hide');
            toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
        });
    }else{
        confirm('Please Fill Transaction Name')
    }
});
});