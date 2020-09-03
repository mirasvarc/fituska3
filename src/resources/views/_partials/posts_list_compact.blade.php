<div class="row">
    <div class="col-8">
        <div class="course-posts">
            <div class="row course-post-header-compact">
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
            <a href="/post/{{$course->code}}/{{$post->id}}" class="post-link">
            <div class="row course-post-compact">
                <div class="col-4">
                    {{$post->title}}
                </div>
                <div class="col-2" style="text-align:center">
                    <span>{{$post->type}}</span>
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
            </a>
            @endforeach
        </div>
    </div>
</div>
