@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="back-button">
                <button class="btn btn-primary">
                    <a href="/course/{{$course->code}}">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                        &nbsp;
                        Zpět
                    </a>
                </button>
                @if($post->isAuthor())

                    {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Opravdu chcete smazat příspěvek?")', 'style' => 'float:right;margin-right:15px;'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::button('<i class="fa fa-trash-alt"></i> Odstranit', ['type' => 'submit', 'class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}

                    {!!Form::open(['action' => ['PostController@edit', $course->code, $post->id], 'method' => 'POST', 'style' => 'float:right;margin-right:5px;'])!!}
                        {{Form::hidden('_method', 'GET')}}
                        {{Form::button('<i class="fa fa-edit"></i> Upravit', ['type' => 'submit', 'class' => 'btn btn-primary'])}}
                    {!!Form::close()!!}


                @endif
            </div>


    </div>
</div>
@endsection

@push('scripts')
<script>
var postContent = {!! $content_json !!}

document.getElementById("post-content").innerHTML = postContent.content;

</script>


<script>
    tinymce.init({
        selector: 'textarea',
        width: "100%",
        height: 200,
        plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste help codesample code'
        ],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | codesample code link image | print preview media fullpage | ' +
        'forecolor backcolor emoticons | help',
        menubar: 'favs edit view insert format tools table help',
        content_css: '//www.tiny.cloud/css/codepen.min.css',
        codesample_global_prismjs: true,
        codesample_languages: [
            { text: 'HTML/XML', value: 'markup' },
            { text: 'JavaScript', value: 'javascript' },
            { text: 'CSS', value: 'css' },
            { text: 'PHP', value: 'php' },
            { text: 'Ruby', value: 'ruby' },
            { text: 'Python', value: 'python' },
            { text: 'Java', value: 'java' },
            { text: 'C', value: 'c' },
            { text: 'C#', value: 'csharp' },
            { text: 'C++', value: 'cpp' },
            { text: 'VHDL', value: 'vhdl'}
            //TODO: add languages
        ]
    });
</script>
