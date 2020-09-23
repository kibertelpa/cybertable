
<? //vardump($columns)?>

<script>

jQuery(document).ready(function() {	

    $("#<?=$datatable?>").dataTable({ // here you can define a typical datatable settings from http://datatables.net/usage/options 
        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        "rowId": "<?=$rowId?>",
        "orderCellsTop": true,
	"serverSide": true,
	"responsive": true,
        "lengthMenu": [
            [10, 16, 20, 50, 100, 150, -1],
            [10, 16, 20, 50, 100, 150, "All"] // change per page values here
        ],
        "pageLength": 16, // default record count per page
        "ajax": {
            "url": "<?=$url?>", // ajax source
            "type": 'POST',
			'headers': {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			}
        },
        "columns": [<?=$installColumns?>],
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": '{!!$installRowButtons!!}'
        } ],
        
        <? if($orderBy): ?>
        	"order": [[<?=$orderBy?>,"<?=$orderByPos?>"]]
        <? else: ?>
        	"order": [<?=($checkbox ? '[1,"desc"]' : '[0,"desc"]')?>]              
        <? endif; ?>
    });
    
    
    var tableSearch = $('#<?=$datatable?>').DataTable();
    
	var delayTimer;
	
    $('.form-filter').on( 'keyup change', function () {
    	var type = $(this).data('itype');
    	
    	if(type == 'dropdown'){
			searchInputFields();
		}else{
			
			clearTimeout(delayTimer);
		    delayTimer = setTimeout(function() {

                searchInputFields();
                
		    }, 500);
						
		}		    
    });
    
    function searchInputFields(){
		<? $colcount = 0; ?>	
        <? foreach($columns AS $col): ?>
        	<? if(isset($col['search'])): ?>
        		<? if($col['search']['type'] == 'dateFromTo'): ?>
        			var from 	= $('#<?=$datatable.'_'.$col['name']?>_date_from').val();
        			var to		= $('#<?=$datatable.'_'.$col['name']?>_date_to').val();		
        			tableSearch.column(<?=$colcount?>).search(from + '|' + to);
        		<? else: ?>
        			tableSearch.column(<?=$colcount?>).search($('#<?=$datatable.'_'.$col['name']?>').val());
        		<? endif; ?>
        		
        	<? endif; ?>
        	<? $colcount++; ?>
        <? endforeach; ?>
        
        tableSearch.draw();
	}

   $('#<?=$datatable?>').on( 'click', 'tr', function () {
   		 //console.log($(this));
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }else {
            $("#<?=$datatable?>").DataTable().$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
	});


    $('#{{$datatable}} input').on("click", function (event) {       
        event.stopImmediatePropagation();
    });
        
	function deleteDatagridRow(){
		var type = $('#<?=$datatable?>ModalDelete').data('buttonType');
		
		if(type == 1){		
			var url = $("#<?=$datatable?>delete").data('href');
			var id	= $("#<?=$datatable?>delete").data('id');		
		}else{
			var url = $('#<?=$datatable?>ModalDelete').data('url');
			var id	= $('#<?=$datatable?>ModalDelete').data('id');
		}

		
		if(id == ''){
			$('#msgTextForDel').html('Jūs nesat izvēlējies ierakstu').delay(5000).hide(1000);
		}else{
			$.post(url+id);
			$('#<?=$datatable?>').DataTable().ajax.reload();
			$('#<?=$datatable?>ModalDelete').modal('hide');
			toastr.info("Notiek ieraksta dzēšana ID:" +id, "Ieraksta dzēšana");
			
			$('#<?=$datatable?>ModalDelete').data('buttonType','');	
			$("#<?=$datatable?>delete").data('href','');
			$("#<?=$datatable?>delete").data('id','');		
		}
	}

	function showDeleteDialog(id,url){
		$('#<?=$datatable?>ModalDelete').data('buttonType',2);
		$('#<?=$datatable?>ModalDelete').data('id',id);
		$('#<?=$datatable?>ModalDelete').data('url',url);
		$('#msgTextForDel').html('Vai patiešām vēlaties dzēst ierakstu! ID: ' + id);
		$('#<?=$datatable?>ModalDelete').modal('show');
		
	}

	function getSelectedData<?=$datatable?>(){
		var table = $("#<?=$datatable?>").DataTable(); 
		var rows = table.rows('.selected').indexes();
		var data = table.rows( rows[0] ).data();
		return data[0];
	}

	$(document).on('click','.datatableActionButton',function(){
		var data = getSelectedData<?=$datatable?>();
		var to = $(this).data('href');		
		window.location.href = to + data.id.toString();
	});
	
	$(document).on("click",".deleteRow",function() {	
		var data 	= getSelectedData<?=$datatable?>();
		var to 		= $(this).data('href');	
		var href 	= to + data.id.toString();
		
		 	swal.fire({
		        title: 'Vai pa tiešām vēlaties dzēst ierakstu?',
		        text: 'Atgūt datus vairs nebūs iespējams! (ID:' + data.id + ')',
		        icon: 'warning',
		        showCancelButton: true,
		        confirmButtonText: 'Jā, dzēst!',
		        cancelButtonText: 'Atcelt',
		        confirmButtonColor: "#c72103"
				}).then(function(result) {	
				
					if (result.value) {
						$.get(href,function(data){
							//console.log(result.value);
							if(data == 'true'){
								swal.fire(
									'Dzēsts!',
									'Jūsu ieraksts ir dzēsts.',
									'success'
								)
							}else{
								swal.fire(
									'Nav dzēsts!',
									'Jūsu ierakstu nevar izdzēst, ispējasm ir vel saisaiste ar citiem ierakstiem.',
									'warning'
								)							
							}
						});            	
					}
				});
				
				return false;
		});		
 });
 
</script>

<? if($buttons && is_array($buttons) && count($buttons) > 0):?>
	<? foreach($buttons AS $keyName => $btn): ?>	
		<? if($btn['modal'] === true): ?>	
		<script>
			$( "#<?=$datatable.$keyName?>" ).mousedown(function() {
				var table = $("#<?=$datatable?>").DataTable(); 
				var rows = table.rows('.selected').indexes();
				
				console.log(rows);
				
				if(typeof rows[0]  !== "undefined"){							
					var rowdata = table.rows( rows[0] ).data();
			    	var href = $(this).data('href');					    					    
					$(this).data('id',rowdata[0].id);
			    	$(this).attr('href',href+rowdata[0].id);
				}
				
			});
		</script>
		<? endif; ?>		
	<? endforeach; ?>
<? endif; ?>