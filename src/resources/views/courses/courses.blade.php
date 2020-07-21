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
    layout:"fitDataTable",
    responsiveLayout: "collapse",
    resizableColumns:false,
    columns:[
        {title:"id", field:"id", visible:false},
	 	{title:"Zkratka", field:"code"},
	 	{title:"Název", field:"full_name", hozAlign:"left", resizable:true},
	 	{title:"Rok", field:"year"},
        {title:"Ročník", field:"study_year"},
        {title:"Typ", field:"type"},

 	],
 	rowClick:function(e, row){
        window.location = "/courses/" + row.getData().code + "/" + row.getData().year;
 	},
});

</script>

@endpush
