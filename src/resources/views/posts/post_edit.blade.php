@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form method="post" action="{{ route('posts.update', $post->id) }}" class="form form-horizontal">
                @csrf
                @method('PUT')
                <input type="hidden" name="code" value="{{$code}}">
                <div class="form-group">
                    <label>Titulek</label>
                    <input type="text" name="title" class="form-control" value="{{$post->title}}" required/>
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <textarea name="content" rows="5" cols="40" class="form-control tinymce-editor"></textarea>
                </div>
                <div class="form-group">
                    <label>Typ</label>
                    <select id="type" name="type" class="form-control" value="{{$post->type}}">
                        <option value="Zadání">Zadání</option>
                        <option value="Materiály">Materiály</option>
                        <option value="Diskuze">Diskuze</option>
                        <option value="Ostatní">Ostatní</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

    var postContent = {!! $post_content_json !!}

    tinymce.init({
        selector: 'textarea',
        setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent(postContent.content);
            });
        },
        width: "100%",
        height: 500,
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
@endpush
