@inject('posts', 'App\Post')

<div class="row">
    <div class="col-md-2 col-6">
        <div class="new-post">
            <button class="btn btn-primary" data-toggle="modal" data-target="#upload-exam">
                <i class="fa fa-upload"></i>
                &nbsp;
                Nahrát zadání
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-exam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nahrát zadání</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('exam.upload') }}" class="form form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <div class="form-group">
                        <label for="files">Přiložit soubory</label>
                        <input type="file" id="files" class="form-control-file" name="files[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Nahrát</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="course-posts">
            <div class="row course-post-header-compact">
                <div class="col-4">
                    <span class="posts-header">Název souboru</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Typ</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Datum vložení</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Autor</span>
                </div>
            </div>
            @foreach($all_files as $file)
                @if($file->is_exam == 1)
                <div class="row course-post-compact">
                    <div class="col-4">
                        <a href="/storage/files/{{$course->code}}/{{$file->path}}" target="_blank">{{$file->name}}</a>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="normal">{{$file->type}}</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span>{{$file->created_at}}</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        @if($file->author()->first())
                        <span><a href="/user/{{$file->author()->first()->id}}">{{$file->author()->first()->username}}</a></span>
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

</div>
