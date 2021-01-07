@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="back-button">
                <button class="btn btn-primary">
                    <a href="/course/{{$course->code}}/topic/{{$topic->id}}">
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
                    <p>
                        <a href="/user/{{$post->author()->first()->id}}">
                            {{$post->author()->first()->username}}
                        </a>
                        {{$post->created_at}}
                    </p>
                </div>
                <div class="post-content" id="post-content">

                </div>
                <div class="post-files">
                    <p class="bold post-files-header">Přiložené soubory:</p>
                    @foreach($post->files()->get() as $file)
                        <p class="post-file"><a href="/storage/files/{{$course->code}}/{{$file->path}}" target="_blank">{{$file->name}}</a></p>
                    @endforeach
                </div>
            </div>

            <div class="comments">
                @foreach($comments as $comment)
                    @if(!$comment->parent_id)
                        <div class="comment">
                            <div class="author">
                                <a href="/user/{{$comment->author()->first()->id}}">
                                    {{$comment->author()->first()->username}}
                                </a>
                                :
                            </div>
                            <div class="content ml-10">
                                {!! $comment->content !!}
                                <br>
                                @if(count($comment->replies()->get()) < 1)
                                    <div class="replies mb-5">
                                        Odpovědět
                                    </div>
                                @elseif(count($comment->replies()->get()) == 1)
                                    <div class="replies mb-5">
                                        {{count($comment->replies()->get())}}
                                        odpověď
                                    </div>
                                @elseif(count($comment->replies()->get()) == 2
                                || count($comment->replies()->get()) == 3
                                || count($comment->replies()->get()) == 4
                                )
                                <div class="replies mb-5">
                                    {{count($comment->replies()->get())}}
                                    odpověďi
                                </div>
                                @else
                                    <div class="replies mb-5">
                                        {{count($comment->replies()->get())}}
                                        odpovědí
                                    </div>
                                @endif
                                <div id="replies-content" class="replies-content">
                                    @foreach($comment->replies()->get() as $reply)
                                    <div class="border-bottom">
                                        <a href="/user/{{$reply->author()->first()->id}}">
                                            {{$reply->author()->first()->username}}
                                        </a>
                                        :
                                        <span class="ml-10"> {!! $reply->content !!}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="reply-form" class="mt-25">
                                    <form method="post" action="javascript:void(0)" class="form form-horizontal" id="add-reply-form">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <input type="hidden" name="author_id" value="{{auth()->user()->id}}">
                                        <input type="hidden" name="parent_id" value="{{$comment->id}}">

                                        <div class="form-group">
                                            <textarea name="content" rows="5" cols="40" class="form-control tinymce-editor"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Odeslat" class="btn btn-primary add-reply"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           {{-- <div class="buttons">
                                <span class="reply-icon"><i id="reply" class="fas fa-reply"></i></span>
                                &nbsp;
                                <i id="options" class="fas fa-ellipsis-v"></i>
                            </div>--}}

                        </div>
                    @endif

                @endforeach

            </div>

                <form id="add-comment-form" method="post" action="javascript:void(0)" class="form form-horizontal">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <input type="hidden" name="author_id" value="{{auth()->user()->id}}">

                    <div class="form-group">
                        <textarea name="content" rows="5" cols="40" class="form-control tinymce-editor"></textarea>
                    </div>
                    <div class="form-group">
                        <input id="add-comment" type="submit" value="Odeslat" class="btn btn-primary"/>
                    </div>
                </form>

        </div>
        <div class="col" style="display:none;">

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
    // TODO: replies are added to last comment, idk why
    $(document).ready(function(){
        $('#add-comment').click(function(e){
            console.log("test")
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // manually get content of text editor
            var content =   tinyMCE.activeEditor.getContent();
            $('textarea[name=content]').val(content);

            $.ajax({
                url: "{{ url('add-comment-form-submit')}}",
                method: 'post',
                data: $('#add-comment-form').serialize(),
                success: function(response){
                    console.log($('#add-comment-form').serialize());
                    $('#add-comment').html('Submit');
                    document.getElementById("add-comment-form").reset();
                }
            });
        });

        $('.add-reply').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // manually get content of text editor
            var content =   tinyMCE.activeEditor.getContent();
            $('textarea[name=content]').val(content);
            $.ajax({
                url: "{{ url('add-comment-form-submit')}}",
                method: 'post',
                data: $('#add-reply-form').serialize(),
                success: function(response){
                    console.log($('#add-reply-form').serialize());
                    $('.add-reply').html('Submit');
                    document.getElementById("add-reply-form").reset();
                }
            });
        });
    });


</script>

<script>

    var acc = document.getElementsByClassName("replies");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {

        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        var form = panel.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
        if (form.style.display === "block") {
            form.style.display = "none";
        } else {
            form.style.display = "block";
        }
    });
    }



// TODO: nextElementSibling not working, obviously
// FIXME
    var acc2 = document.getElementsByClassName("reply-icon");
    var j;

    for (j = 0; j < acc2.length; j++) {
    acc2[j].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.previousElementSibling;
        var form = panel.child().last();
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
        if (form.style.display === "block") {
            form.style.display = "none";
        } else {
            form.style.display = "block";
        }
    });
    }


</script>
@endpush
