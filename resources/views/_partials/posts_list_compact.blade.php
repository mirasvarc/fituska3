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
                @if(!$user->hasSeenPost()->where('post_id', $post->id)->exists())
                    <div class="row course-post-compact bold">
                @else
                    <div class="row course-post-compact">
                @endif
                        <div class="col-4">
                            {{$post->title}}
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span class="normal">{{$post->type}}</span>
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
    @include('_partials/posts_list_right_panel')
</div>
