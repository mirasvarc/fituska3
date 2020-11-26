

<div id="courses-table"></div>


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
