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
    layout:"fitColumns",
    responsiveLayout: "collapse",
    resizableColumns:false,
    columns:[
	 	{title:"Zkratka", field:"code", width:150},
	 	{title:"Název", field:"full_name", hozAlign:"left"},
	 	{title:"Rok", field:"year", width:150},

 	],
 	rowClick:function(e, row){ //trigger an alert message when the row is clicked
 		alert("Row " + row.getData().id + " Clicked!!!!");
 	},
});

</script>

@endpush
