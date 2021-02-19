<div class="row">
    <div class="col-md-4 col-2">
        <div class="row">
            <div class="new-post">
                <button class="btn btn-primary">
                    <a href="/course/{{$course->code}}">
                        <i class="fa fa-angle-left"></i>
                        &nbsp;
                        Zpět
                    </a>
                </button>
            </div>
            <div class="new-post">
                <button class="btn btn-primary">
                    <a href="/course/{{$course->code}}/topic/{{$topic_id}}/create-post">
                        <i class="fa fa-plus-circle"></i>
                        &nbsp;
                        Nový příspěvek
                    </a>
                </button>
            </div>
            @if(Auth::user()->canModerate())
            <div class="new-post">
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete-topic">
                    <i class="fa fa-trash-alt"></i>
                    &nbsp;
                    Odstranit téma
                </button>
            </div>
            @endif
        </div>
    </div>

    <!-- delte topic modal -->
    <div class="modal fade" id="delete-topic" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Opravdu chcete odstranit toto téma?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zpět</button>
                    <a href="/course/{{$course->code}}/topic/{{$topic_id}}/delete" class="btn btn-danger">
                        <i class="fa fa-trash-alt"></i>
                        &nbsp;
                        Odstranit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5 col-12 hidden">
        <div class="course-detail-menu">
            <label for="types" style="margin-right:10px;">Typ: </label>
            <select id="types" name="types" form="typesform">
                <option value="Zadání">Zadání</option>
                <option value="Materiály">Materiály</option>
                <option value="Diskuze">Diskuze</option>
                <option value="Ostatní">Ostatní</option>
            </select>

        </div>
    </div>
    <div class="col-md-4 col-4 text-right">
        <div class="toggle-all">
            <button class="btn btn-primary" id="toggle-all">
                    Rozbalit vše
            </button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-12">
        <div class="course-posts">
            <div class="row course-post-header">
                <div class="col-lg-4 col-2">
                    <span class="posts-header">Název</span>
                </div>
                <div class="col-lg-2 col-3" style="text-align:center">
                    <span class="posts-header">Typ</span>
                </div>
                <div class="col-lg-2 col-3" style="text-align:center">
                    <span class="posts-header">Datum</span>
                </div>
                <div class="col-lg-2 col-2" style="text-align:center">
                    <span class="posts-header">Autor</span>
                </div>
                <div class="col-lg-2 col-1 d-none d-sm-block" style="text-align:center">
                    <span class="posts-header">Komentáře</span>
                </div>
            </div>
            @foreach($posts as $post)
            {{--<a href="/post/{{$course->code}}/{{$post->id}}" class="post-link">--}}
                @if(!$user->hasSeenPost()->where('post_id', $post->id)->exists())
                    <div class="row course-post bold" id="{{$post->id}}">
                @else
                    <div class="row course-post" id="{{$post->id}}">
                @endif
                        <div class="col-lg-4 col-2">
                            {{$post->title}}
                        </div>
                        <div class="col-lg-2 col-3" style="text-align:center">
                            <span class="post-type normal">{{$post->type}}</span>
                        </div>
                        <div class="col-lg-2 col-3" style="text-align:center">
                            <span>{{$post->created_at}}</span>
                        </div>
                        <div class="col-lg-2 col-2" style="text-align:center">
                            <span>{{$post->author()->first()->username}}</span>
                        </div>
                        <div class="col-lg-2 col-1" style="text-align:center">
                            <i class="far fa-comment"></i>
                            <span>{{count($post->comments()->get())}}</span>
                        </div>
            </div>
            {{--</a>--}}
            <div class="course-post-content">
                <div class="post-content">{!! $post->content !!}</div>
                <div class="post-link-container text-right">
                    <a href="/post/{{$course->code}}/{{$post->id}}" class="post-link">Otevřít příspěvek</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@push('scripts')

<script>

var acc = document.getElementsByClassName("course-post");
var i;

// Expand post
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function(e) {

        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
        panel.style.display = "none";
        } else {
        panel.style.display = "block";
        }



    });
}

// Mark post as read
$(".course-post").click(function(e){
    $(this).removeClass('bold');
    e.preventDefault();
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    $.ajax({
        url: "{{ url('open-post')}}",
        method: 'post',
        data:  {id: $(this).attr('id')},
        success: function(response){

        },
        error: function(response){
            console.log(response);
        }

    });
});

// expand all posts
var toggleAll = document.getElementById('toggle-all');
toggleAll.addEventListener('click', function(){
    for (i = 0; i < acc.length; i++) {
        acc[i].classList.toggle("active");
        var panel = acc[i].nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    }
});


</script>

@endpush
