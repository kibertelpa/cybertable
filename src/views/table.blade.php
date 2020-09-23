<div class="portlet">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa <?=(isset($icon) ? $icon : 'fa-list')?>"></i><?=$title?>
		</div>
		<?=$installButtons?>
	</div>
	<div class="portlet-body">
		<div class="table-container">
            <div class="table-actions-wrapper">
	        <? if($isEditable == true) : ?>
	            <div class="btn-group">
	                <button id="<?=$datatable?>_add_new" class="btn green"> Jauns ieraksts
	                    <i class="fa fa-plus"></i>
	                </button>
	            </div>
	        <? endif; ?>
	        
			<? if($checkbox): ?>
			
				<span>
				</span>
				<select class="table-group-action-input form-control input-inline input-small input-sm">
					<option value="">Select...</option>
					<? if($columns['checkbox']['data']):?>
						<? foreach($columns['checkbox']['data'] AS $key => $val): ?>
							<option value="<?=$key?>"><?=$val?></option>
						<? endforeach; ?>
					<? endif; ?>
				</select>
				<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Apstiprināt</button>
			
			<? endif; ?>
				
			</div>
			<table class="table display compact table-striped table-bordered table-hover" id="<?=$datatable?>">
				<thead>
					<tr role="row" class="heading filter">
						<? foreach($columns AS $keyId => $col): ?>
							<th width="<?=$col['width']?>" data-name="<?=$keyId?>">				
								<? if($keyId == 'checkbox'): ?>
								<input type="checkbox" class="group-checkable">
								<? endif; ?>
								
								<? if(isset($col['search'])): ?>
									@include("datadable::input.".$col['search']['type'],['input'=> $col])
								<? else: ?>
									<?=(isset($col['title']) ? $col['title'] : '') ?>
								<? endif; ?>
							</th>
						<? endforeach; ?>
					</tr>
				</thead>
				<tbody>
	           
				</tbody>
			</table>
		</div>
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