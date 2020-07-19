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

var tabledata = [
 	{id:1, name:"Oli Bob", age:"12", col:"red", dob:""},
 	{id:2, name:"Mary May", age:"1", col:"blue", dob:"14/05/1982"},
 	{id:3, name:"Christine Lobowski", age:"42", col:"green", dob:"22/05/1982"},
 	{id:4, name:"Brendon Philips", age:"125", col:"orange", dob:"01/08/1980"},
 	{id:5, name:"Margret Marmajuke", age:"16", col:"yellow", dob:"31/01/1999"},
];

var data = {!! $courses !!};
console.log(data)

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
