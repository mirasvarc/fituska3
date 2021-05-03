<h2 class="mt-25">
    Sdílené dokumenty
    <button type="button" class="btn btn-primary " style="width: unset" title="Vytvořit nový soubor" data-toggle="modal" data-target="#add-shared-file-modal">
        <i class="fa fa-plus-circle"></i>&nbsp;Vytvořit
    </button>
</h2>

{{--<button id="authorize_button" style="display: none;" class="btn btn-secondary">Autorizovat</button>
<button id="signout_button" style="display: none;" class="btn btn-secondary">Odhlásit</button>--}}
<div class="row">
    <div class="col-10">
        <div class="course-posts">
            <div class="row course-post-header-compact">
                <div class="col-4">
                    <span class="posts-header">Název souboru</span>
                </div>
                <div class="col-2" style="text-align:center">

                </div>
                <div class="col-2" style="text-align:center">

                </div>
                <div class="col-2" style="text-align:center">

                </div>
            </div>
            <div id="shared-files">
                @if(count($shared_files) != 0)
                    @foreach($shared_files as $file)
                    <div class="row course-post-compact">
                        <div class="col-4">
                            <span>{{$file->name}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <a href="https://docs.google.com/document/d/{{$file->getId()}}" target="_blank">Otevřít</a>
                            <span class="normal"></span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span></span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span><a href=""></a></span>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="row course-post-compact">
                    <div class="col-6">
                        <span>Žádný soubor nenalezen.</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-shared-file-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Přidat událost do kalendáře</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('create-shared-file') }}" id="add-file-form">
                    @csrf
                    <input type="hidden" name="file_course_code" value="{{$course->code}}">
                    <div class="form-group">
                        <label for="event_name">Název: *&nbsp;</label>
                        <input type="text" name="shared_file_name" class="form-control" required id="EventNameDrive">
                    </div>
                    <input type="submit" onclick="createSharedFile()" data-dismiss="modal" class="btn btn-success btn-addEvent" value="Přidat">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function createSharedFile() {
        document.getElementById("add-file-form").submit();
    }
</script>
