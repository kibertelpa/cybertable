    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"><?=$title?>
                    <div class="text-muted pt-2 font-size-sm">Datatable initialized from HTML table</div>
                </h3>
            </div>
            <div class="card-toolbar">              
                <?=$installButtons?>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">
        
            <table class="table display compact table-bordered table-hover" id="<?=$datatable?>">
            <thead>
			<tr role="row" class="heading">
				<? foreach($columns AS $keyId => $col): ?>
					<th>
						<?=(isset($col['title']) ? $col['title'] : '') ?> 
					</th>
				<? endforeach; ?>
			</tr>
			<tr class="filter-row">
				<? foreach($columns AS $keyId => $col): ?>
					<td width="<?=$col['width']?>" data-name="<?=$keyId?>">
					
					<? if($keyId == 'checkbox'): ?>
					<input type="checkbox" class="group-checkable">
					<? endif; ?>
					
					<? if(isset($col['search'])): ?>
						@include("datatable::inputs.".$col['search']['type'],['input' => $col])
					<? else: ?>
						-
					<? endif; ?>
					
					</td>
				<? endforeach; ?>
			</tr>
			</thead>
			<tbody>
           
			</tbody>
			</table>

        </div>

    </div>


<div class="modal fade" id="<?=$datatable?>ModalDelete" data-id="" data-url="" data-buttonType="" role="basic" aria-hidden="true">
	<div class="modal-dialog panel-danger">
		<div class="modal-content">
			<div class="modal-header panel-heading">
				<button class="close" aria-hidden="true" data-dismiss="modal" type="button" data-backdrop=""></button>
				<h3 class="modal-title ">Dzēst!!!</h3>
			</div>
			<div class="modal-body">	
				<div class="note note-danger">
	            	<p id="msgTextForDel">

	            	</p>	
				</div>
				<div style="clear: both;"></div>
			</div>	
			<div class="modal-footer">
				<button class="btn default" data-dismiss="modal" type="button" data-backdrop="">Atcelt</button>
				<button class="btn green" type="button" onclick="deleteDatagridRow();">Dzēst</button>
			</div>
		</div>
	</div>
</div>