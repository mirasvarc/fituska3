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

                <div class="post">
                    <div class="post-title">
                        <h1>{{$post->title}}</h1>
                        <p><a href="/user/{{$post->author()->first()->id}}">{{$post->author()->first()->username}}</a>, {{$post->created_at}}</Datum:>
                    </div>
                    <div class="post-content" id="post-content">

                    </div>

                </div>

                    <form id="add-comment-form" method="post" action="javascript:void(0)" class="form form-horizontal">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <input type="hidden" name="author_id" value="{{auth()->user()->id}}">

                        <div class="form-group">
                            <textarea name="content" rows="5" cols="40" class="form-control tinymce-editor"></textarea>
                        </div>
                        <div class="form-group">
                            <input id="add-comment" type="submit" value="Submit" class="btn btn-primary"/>
                        </div>
                    </form>

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

<script>
    $(document).ready(function(){
        $('#add-comment').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#add-comment').val('Sending..');

            // manually get content of text editor
            var content =   tinyMCE.activeEditor.getContent();
            $('textarea[name=content]').val(content);

            $.ajax({
                url: "{{ url('add-comment-form-submit')}}",
                method: 'post',
                data: $('#add-comment-form').serialize(),
                success: function(response){
                    $('#add-comment').html('Submit');
                    document.getElementById("add-comment-form").reset();
                }
            });
        });
    });


</script>
@endpush
