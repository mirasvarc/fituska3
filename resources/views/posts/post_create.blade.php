@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form method="post" action="{{ route('posts.store') }}" class="form form-horizontal" enctype="multipart/form-data">
                @csrf
                @if(!isset($isForum))
                    <input type="hidden" name="code" value="{{$code}}">
                @else
                    <input type="hidden" name="isforum" value="{{$isForum}}">
                @endif
                <input type="hidden" name="topic_id" value="{{$topic_id}}">
                <div class="form-group">
                    <label>Titulek</label>
                    <input type="text" name="title" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <textarea name="content" rows="5" cols="40" class="form-control tinymce-editor"></textarea>
                </div>
                @if(!isset($isForum))
                <div class="form-group">
                    <label for="files">Přiložit soubory</label>
                    <input type="file" id="files" class="form-control-file" name="files[]" multiple>
                </div>

                <div class="form-group">
                    <label>Typ</label>
                    <select id="type" name="type" class="form-control">
                        <option value="Zadání">Zadání</option>
                        <option value="Materiály">Materiály</option>
                        <option value="Diskuze">Diskuze</option>
                        <option value="Ostatní">Ostatní</option>
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <label for="files">Vložit příspěvek anonymně</label>
                    &nbsp;
                    <input type="checkbox" class="checkbox" name="anonym">
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
    tinymce.init({
        selector: 'textarea',
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
