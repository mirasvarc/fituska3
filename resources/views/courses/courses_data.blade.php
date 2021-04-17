
@foreach($data as $row)
    <tr class="course-table-link" onclick="window.location.href='/course/{{ $row->code}}'">
       <td>{{ $row->code }}</td>
       <td>{{ $row->full_name }}</td>
    </tr>
@endforeach

<tr>
    <td colspan="3" align="center">
        {!! $data->links() !!}
    </td>
</tr>

<style>
    .course-table-link:hover {
        cursor: pointer;
    }
</style>
