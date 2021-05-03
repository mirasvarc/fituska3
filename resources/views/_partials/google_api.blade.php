
<script type="text/javascript">


    function storeCalToDB(calendar_id, user_id) {
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/calendar/store')}}",
                method: 'post',
                data: {'calendar_id': calendar_id, 'user_id': user_id},
                success: function(response){
                    console.log(response);
                }
            });
        });
    }


    function followCalendar() {
        var calendar_id = $('#course-name').val();
        var course = $('#course-code').val();
        var user_id = "{{ auth()->user()->id }}";
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/calendar/follow')}}",
                method: 'post',
                data: {'course': course, 'user_id': user_id},
                success: function(response){
                    console.log(response);
                    $('#followButton').hide();
                }
            });

        });
    }

    function unfollowCalendar() {
        var calendar_id = $('#course-name').val();
        var user_id = "{{ auth()->user()->id }}";
        var course = $('#course-code').val();
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/calendar/follow')}}",
                method: 'post',
                data: {'course': course, 'user_id': user_id},
                success: function(response){
                    console.log(response);
                    $('#unfollowButton').hide();
                }
            });
        });
    }

    /*
     * Update course calendar id in database
     * @param course code of the course
     * @param colendar_id id of the created calendar
    */
    function updateCalId(course, calendar_id) {

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/course/calendar/update')}}",
                method: 'post',
                data: {'code':course, 'calendar_id': calendar_id},
                success: function(response){
                    console.log(response);
                }
            });
        });
    }




   </script>
