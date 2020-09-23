{{-- Extends layout --}}
@extends('layout.default')

@section('content')
	<?=$tadatable['html']?>
@endsection

{{-- Styles Section --}}
@section('styles')
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css?v2') }}" rel="stylesheet" type="text/css"/>
	<style>
		.heading input::placeholder {
			color: #404851;
		}
		
		
		.dataTables_wrapper .dataTable.compact td{
			padding-top: 2px;
			padding-bottom: 2px;
		}
		
		.dataTables_wrapper .dataTable.compact filter-row td{
			padding:1px;
			padding-left:2px !important;
			padding-right:2px !important;		
		}
		
		.dataTables_wrapper .dataTable.compact .form-control{
			padding: 5px;
			height: auto;
		}
	</style>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
	<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<script src="//cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
	<script src="//cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>	

    <?=$tadatable['js']?>
@endsection
