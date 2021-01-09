
<div class="row">
    <div class="col-md-12">
        <div class="course-upper-menu">
            <div id="discussion-btn" class="course-menu-btn active-btn">Diskuze</div>
            <div id="files-btn" class="course-menu-btn">Soubory</div>
            <div id="exams-btn" class="course-menu-btn">Zadání</div>
        </div>
    </div>
</div>


<script>
    $('.course-menu-btn').on("click", function(){
        $('.active-btn').removeClass('active-btn');
        $(this).addClass('active-btn');

    });

    $('#discussion-btn').on('click', function(){
        $('#discussion-body').show();
        $('#files-body').hide();
        $('#exams-body').hide();
    });
    $('#files-btn').on('click', function(){
        $('#discussion-body').hide();
        $('#files-body').show();
        $('#exams-body').hide();
    });
    $('#exams-btn').on('click', function(){
        $('#exams-body').show();
        $('#discussion-body').hide();
        $('#files-body').hide();
    });
</script>

