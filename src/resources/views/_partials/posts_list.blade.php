<div class="row">
    <div class="col-8">
        <div class="course-posts">
            <div class="row course-post-header">
                <div class="col-4">
                    <span class="posts-header">Název</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Typ</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Datum</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Autor</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Komentáře</span>
                </div>
            </div>
            @foreach($posts as $post)
            {{--<a href="/post/{{$course->code}}/{{$post->id}}" class="post-link">--}}
                @if(!$user->hasSeenPost()->where('post_id', $post->id)->exists())
                    <div class="row course-post bold">
                @else
                    <div class="row course-post">
                @endif
                        <div class="col-4">
                            {{$post->title}}
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span class="post-type normal">{{$post->type}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span>{{$post->created_at}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span>{{$post->author()->first()->username}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
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
    @include('_partials/posts_list_right_panel')
</div>


@push('scripts')

<script>

var acc = document.getElementsByClassName("course-post");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {

    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

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
