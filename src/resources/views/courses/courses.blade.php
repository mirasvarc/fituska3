@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="courses-table"></div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>

var data = {!! $courses !!};

var table = new Tabulator("#courses-table", {
	height:"100%",
	data:data,
    layout:"fitDataFill",
    responsiveLayout: "collapse",
    resizableColumns:false,
    columns:[
        {title:"id", field:"id", visible:false},
	 	{title:"Zkratka", field:"code"},
	 	{title:"Název", field:"full_name", hozAlign:"left", width:400},
        {title:"Ročník", field:"study_year"},
        {title:"Typ", field:"type"},

 	],
 	rowClick:function(e, row){
        window.location = "/course/" + row.getData().code;
 	},
});

</script>

@endpush
