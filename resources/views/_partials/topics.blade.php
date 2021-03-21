
@if(Auth::user()->canModerate())
<div class="row">
    <div class="col-md-2 col-6">
        <div class="new-post">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-topic-modal">
                <i class="fa fa-plus-circle"></i>
                &nbsp;
                Nové téma
            </button>
        </div>
    </div>
</div>
@endif

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="create-topic-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vytvořit nové téma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="/course/{{$course->code}}/create-topic" class="form" method="POST">
                    @csrf
                    <label for="topic-name">Název</label>
                    <input type="hidden" name="course_code" value="{{$course->code}}">
                    <input type="text" name="topic_name" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zpět</button>
                <button type="submit" class="btn btn-primary">Vytvořit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 col-12">
        <div class="course-posts">
            <div class="row course-post-header">
                <div class="col-lg-8 col-2">
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
                        <div class="col-lg-8 col-2">
                            {{$topic->name}}
                        </div>

                        <div class="col-lg-2 col-1" style="text-align:center">
                            <span>{{count($topic->posts()->get())}}</span>
                        </div>

            </div>
            </a>
            @endforeach
        </div>
    </div>
</div>


