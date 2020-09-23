<?php
$button = '';

if(isset($buttons['add'])){
	unset($buttons['add']);
}

if(count($buttons) > 3):
	$button .= '<div class="dropdown dropdown-inline">';
	$button .= '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">';
	$button .= '<i class="fas fa-ellipsis-h"></i>';
	$button .= '</a>';
	$button .= '<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">';
	$button .= '<ul class="nav nav-hoverable flex-column">';

	foreach($buttons AS $keyName => $btn):
		if($keyName == 'delete'):
			$button .= '<div class="dropdown-divider"></div>';
			$button .= '<li class="nav-item"><a href="#" id="'.$datatable.$keyName.'" data-href="'.$btn['url'].'" class="nav-link deleteRow">'.($btn['icon'] ? '<i class="nav-icon '.$btn['icon'].' text-danger"></i>' : '').'<span class="nav-text">'.$btn['title'].'</span></a></li>';	
			continue;
		endif;		
		if($btn['modal'] === true):
			$button .= '<li class="nav-item"><a href="#" id="'.$datatable.$keyName.'" data-toggle="modal" data-target="#'.$btn['modal-target'].'" data-href="'.$btn['url'].'" href="'.$btn['url'].'" class="nav-link">'.($btn['icon'] ? '<i class="nav-icon '.$btn['icon'].'"></i>' : '').'<span class="nav-text">'.$btn['title'].'</span></a></li>';
		else:
			$button .= '<li class="nav-item"><a href="#" data-href="'.$btn['url'].'" data-action="'.$keyName.'" class="nav-link datatableActionButton">'.($btn['icon'] ? '<i class="nav-icon '.$btn['icon'].'"></i>' : '').'<span class="nav-text">'.$btn['title'].'</span></a></li>';
		endif;			
	endforeach;
	
	$button .= '</ul>';							  	
	$button .= '</div>';							
	$button .= '</div>';
else:
	foreach($buttons AS $keyName => $btn):
		if($keyName == 'delete'):
			$button .= '<a id="'.$datatable.$keyName.'" data-id="" data-href="'.$btn['url'].'" href="" class="btn btn-sm btn-clean btn-icon deleteRow">'.($btn['icon'] ? '<i class="'.$btn['icon'].' text-danger"></i>' : '').'<span class="hidden-480"></span></a>';	
			continue;
		endif;		
		if($btn['modal'] === true):
			$button .= '<a id="'.$datatable.$keyName.'" data-toggle="modal" data-id="" data-target="#'.$btn['modal-target'].'" data-href="'.$btn['url'].'" href="'.($keyName == 'delete' ? '#'.$datatable.'ModalDelete' : $btn['url']).'" class="btn btn-sm btn-clean btn-icon datatableActionButton">'.($btn['icon'] ? '<i class="'.$btn['icon'].' text-primary"></i>' : '').'<span class="hidden-480"></span></a>';
		else:
			$button .= '<a href="#" data-href="'.$btn['url'].'" data-action="'.$keyName.'" class="btn btn-sm btn-clean btn-icon datatableActionButton">'.($btn['icon'] ? '<i class="'.$btn['icon'].' text-primary"></i>' : '').'<span class="hidden-480"></span></a>';
		endif;			
	endforeach;
endif;
?>{!!$button!!}