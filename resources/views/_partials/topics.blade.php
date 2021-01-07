

<div class="row">
    <div class="col-md-2 col-6">
        <div class="new-post">
            <button class="btn btn-primary">
                <a href="/course/{{$course->code}}/create-post">
                    <i class="fa fa-plus-circle"></i>
                    &nbsp;
                    Nové téma
                </a>
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
                <div class="col-lg-2 col-1 d-none d-sm-block" style="text-align:center">
                    <span class="posts-header">Příspěvky</span>
                </div>
            </div>
            @foreach($topics as $topic)
            <a href="/course/{{$course->code}}/topic/{{$topic->id}}" class="post-link">
            {{--    @if(!$user->hasSeenPost()->where('post_id', $post->id)->exists())--}}
                    <div class="row course-post bold" id="{{$topic->id}}">
                {{--@else
                    <div class="row course-post" id="{{$post->id}}">
                @endif--}}
                        <div class="col-lg-4 col-2">
                            {{$topic->name}}
                        </div>

                        <div class="col-lg-2 col-1" style="text-align:center">
                            <i class="far fa-comment"></i>
                          {{--  <span>{{count($post->comments()->get())}}</span>--}}
                        </div>
            </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

