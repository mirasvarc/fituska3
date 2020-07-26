@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form method="post" action="{{ route('posts.store') }}" class="form form-horizontal">
                @csrf
                <input type="hidden" name="code" value="{{$code}}">
                <input type="hidden" name="year" value="{{$year}}">
                <div class="form-group">
                    <label>Titulek</label>
                    <input type="text" name="title" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <textarea name="content" rows="5" cols="40" class="form-control tinymce-editor"></textarea>
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
        'table emoticons template paste help codesample'
        ],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | codesample link image | print preview media fullpage | ' +
        'forecolor backcolor emoticons | help',
        menubar: 'favs edit view insert format tools table help',
        content_css: 'css/content.css',
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
