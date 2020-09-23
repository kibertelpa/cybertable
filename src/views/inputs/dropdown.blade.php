<select name="<?=$this->curentDatagrid.'_'.$input['name']?>" id="<?=$this->curentDatagrid.'_'.$input['name']?>" data-itype="dropdown" class="form-control form-filter input-sm">
	<option value=""></option>
	<? foreach($input['search']['data'] AS $val => $title): ?>
		<option value="<?=$val?>"<?=($input['search']['default_value'] === $val ? ' selected="selected"' : '')?>><?=$title?></option>	
	<? endforeach; ?>
</select>