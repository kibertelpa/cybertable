<?php

namespace Kibertelpa\Cybertable;

use Illuminate\Http\Response;

Class CyberTable {

	function __construct() {
		$this->isQuery = (isset($_POST['columns']) ? true : false);
	}
	var $datagrid_name;
	var $columns = array();
	var $settings = array();
	var $curentName = false;
	var $curentDatagrid = false;
	var $isQuery = false;
	var $curentButton = false;
	
	function datagrid($name,$title,$JsonUrl){
		$this->datagrid[$name] = array();
		$this->datagrid[$name]['datatable']		= $name;
		$this->datagrid[$name]['columns'] 		= array();
		$this->datagrid[$name]['installColumns']= false;
		$this->datagrid[$name]['title'] 		= $title;
		$this->datagrid[$name]['url'] 			= $JsonUrl;
		$this->datagrid[$name]['search'] 		= false;
		$this->datagrid[$name]['rowId'] 		= 'id';
		$this->datagrid[$name]['checkbox'] 		= false;
		$this->datagrid[$name]['selectFrom'] 	= false;
		$this->datagrid[$name]['groupBy'] 		= false;
		$this->datagrid[$name]['countFrom'] 	= false;
		$this->datagrid[$name]['defaultOrder'] 	= false;
		$this->datagrid[$name]['buttons'] 		= array();
		$this->datagrid[$name]['installButtons']= false;
		$this->datagrid[$name]['installRowButtons']= false;
		$this->datagrid[$name]['where'] 		= false;
		$this->datagrid[$name]['isEditable'] 	= false;
		$this->datagrid[$name]['orderBy'] 		= false;
		$this->datagrid[$name]['orderByPos'] 	= false;
		$this->curentDatagrid = $name;
		return $this;
	}
	
	function rowId($rowId = 'id'){
		$this->datagrid[$this->curentDatagrid]['rowId'] = $rowId;
		return $this;
	}
	
	function isEditable(){
		$this->datagrid[$this->curentDatagrid]['isEditable'] = true;		
		return $this;
	}
	
	function addButton($buttonName,$title,$url = '',$column = 'id',$icon = false,$htmlContentTarget = 'crmloadcontent',$tabId = false){
		$this->curentButton = $buttonName;
		
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName] = array();
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['icon'] = false;
		
		
		SWITCH($buttonName){
			case 'new':
				$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['icon'] = 'fa fa-plus';
				break;
			case 'add':
				$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['icon'] = 'fa fa-plus';
				break;
			case 'edit':
				$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['icon'] = 'fa fa-edit';
				break;
			case 'delete':
				$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['icon'] = 'fa fa-trash';
				break;
			case 'del':
				$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['icon'] = 'fa fa-trash';
				break;
			case 'view':
				$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['icon'] = 'fa fa-eye';
				break;
			case 'print':
				$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['icon'] = 'fa fa-print';
				$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['url'] = $this->datagrid[$this->curentDatagrid]['url'].'print/';
				break;
		}
		
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['hidden'] = false;
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['tab'] = $tabId;
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['columnId'] = $column;
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['htmlTargetId'] = $htmlContentTarget;
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['name'] = $buttonName;
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['title'] = $title;
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['url'] = $url;
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['modal'] = false;
		$this->datagrid[$this->curentDatagrid]['buttons'][$buttonName]['modal-target'] = '';
		
		return $this;
	}
	
	function isModal($target = 'crmModal'){
		$this->datagrid[$this->curentDatagrid]['buttons'][$this->curentButton]['modal'] = true;
		$this->datagrid[$this->curentDatagrid]['buttons'][$this->curentButton]['modal-target'] = $target;		
		return $this;
	}
	
	function hideButton(){
		$this->datagrid[$this->curentDatagrid]['buttons'][$this->curentButton]['hidden'] = true;		
		return $this;		
	}
		
	function icon($icon){
		$this->datagrid[$name]['icon'] = $icon;
	}
	
	function addColumn($name,$title,$width = '20%',$styleFormat = false){
		$this->datagrid[$this->curentDatagrid]['columns'][$name]['title'] 	= $title;
		$this->datagrid[$this->curentDatagrid]['columns'][$name]['name'] 	= $name;
		$this->datagrid[$this->curentDatagrid]['columns'][$name]['width'] 	= $width;
		
		if($styleFormat){
			$this->{$this->curentDatagrid.'_'.$name} = $styleFormat;
		}
	
		$this->curentName = $name;
		return $this;
	}
		
	function edit(){
		if($this->datagrid[$this->curentDatagrid]['isEditable'] === true){
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['edit'] = true;
		}
		
		return $this;
	}
	
	function defContent($defaultContent){
		$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['defaultContent'] = $defaultContent;
		return $this;
	}
	
	function className($className){
		$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['className'] = $className;
		return $this;
	}
			
	function order($order = true,$orderParam = 'ASC'){
		$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['order'] = $order;	
		$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['orderParam'] = $orderParam;	
	}
	
	function addCheckbox($columnKey = '', $data = array(),$width = '1%'){
		$this->datagrid[$this->curentDatagrid]['columns']['checkbox']['name'] = 'checkbox';
		$this->datagrid[$this->curentDatagrid]['columns']['checkbox']['columnKey'] = $columnKey;
		$this->datagrid[$this->curentDatagrid]['columns']['checkbox']['width'] = $width;
		$this->datagrid[$this->curentDatagrid]['columns']['checkbox']['order'] = false;	
		$this->datagrid[$this->curentDatagrid]['columns']['checkbox']['data'] = $data;	
		$this->datagrid[$this->curentDatagrid]['checkbox'] = true;
		$this->curentName = 'checkbox';
		return $this;
	}
		
	function addSearch($type = 'text',$tableColumn = false, $placeholder = false,$class = false){
		if($type !== false){
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['type'] = $type;
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['column'] = ($tableColumn ? $tableColumn : $this->curentName);
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['placeholder'] = $placeholder;
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['class'] = $class;
			$this->datagrid[$this->curentDatagrid]['search'] = true;
		}
		return $this;
	}
	
	function linkButton($buttonName){
		$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['link'] = $buttonName;		
		return $this;
	}
	
	function addDropdown($data = false, $tableColumn = false,$defaultValue = '', $class = false){
		if($tableColumn){
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['type'] = 'dropdown';
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['column'] = ($tableColumn ? $tableColumn : $this->curentName);
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['data'] = $data;
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['class'] = $class;
			$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['default_value'] = $defaultValue;
			$this->datagrid[$this->curentDatagrid]['search'] = true;
		}
		return $this;
	}
		
	function addUrl($url){
		$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['url'] = $url;
		return $this;		
	}
	
	function addData($data,$default = false){
		$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['data'] = $data;
		$this->datagrid[$this->curentDatagrid]['columns'][$this->curentName]['search']['default_value'] = $default;
		return $this;
	}

	function installColumns($datagrid_name = false){
		
		if($datagrid_name){
			$this->curentDatagrid = $datagrid_name;
		}
		
		$row = array();
		foreach($this->datagrid[$this->curentDatagrid]['columns'] AS $key => $col){
			$column = array();
			if(isset($col['name'])){
				$column[] = 'data: "'.$col['name'].'"';				
			}
			/*
			if(isset($col['name'])){
				$column[] = 'data: "'.$col['name'].'"';
			}
				*/		
			if(isset($col['order'])){
				$column[] = '"orderable": '.($col['order'] == false ? 'false' : 'true').'';
			}
			
			if(isset($col['defaultContent'])){
				$column[] = '"defaultContent": "'.$col['defaultContent'].'"';
			}
			
			if(isset($col['className'])){
				$column[] = '"className": "'.$col['className'].'"';
			}
									
			if(isset($col['search'])){
				$column[] = '"searchable": true';
			}else{
				$column[] = '"searchable": false';
			}
			
			$row[] = '{'.implode(',',$column).'}';
			unset($column);	
		}
		
		$result = implode(',',$row);
		
		$this->datagrid[$this->curentDatagrid]['installColumns'] = $result;
		return $this;
	}
	
	function installButtons($datagrid_name = false){
		if($datagrid_name){
			$this->curentDatagrid = $datagrid_name;
		}

		$this->datagrid[$this->curentDatagrid]['installButtons'] = view('cybertable::buttons',$this->datagrid[$this->curentDatagrid])->render();
		$this->datagrid[$this->curentDatagrid]['installRowButtons'] = view('cybertable::rowbuttons',$this->datagrid[$this->curentDatagrid])->render();
		return $this;
	}
		
	//TODO: theme make index template		
	function install($datagrid_name = false){
		
		if($datagrid_name){
			$this->curentDatagrid = $datagrid_name;
		}
		
		//if($request->has('columns')){
		//	return $this->dataQuery();
		//}else{			
			$this->installButtons($this->curentDatagrid);
			$this->installColumns($this->curentDatagrid);
		//}
		
		return array(
			'html' 	=> view('cybertable::datatable',$this->datagrid[$this->curentDatagrid])->render(),
			'js' 	=> view('cybertable::js',$this->datagrid[$this->curentDatagrid])->render()
		);
	}
	
	

}