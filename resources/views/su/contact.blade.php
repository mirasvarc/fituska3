@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h1>Kontaktní formulář</h1>
            <p>Tento formulář slouží ke kontaktování Studentské unie.</p>
            <br><br>
            <form action="{{ route('su-send-form') }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-3 offset-2 text-right">
                        <label for="full_name">Jméno a příjmení *:</label>
                    </div>
                    <div class="col-4">
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 offset-2 text-right">
                        <label for="email">Email *:</label>
                    </div>
                    <div class="col-4">
                        <input type="text" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 offset-2 text-right">
                        <label for="msg">Zpráva *:</label>
                    </div>
                    <div class="col-4">
                        <textarea type="text" name="msg" class="form-control" required></textarea>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-7 offset-2 text-right">
                        <input type="submit" class="btn btn-primary" value="Odeslat">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>


@if(isset($_REQUEST['success']))
<script>
    $(window).on('load', function(){
        $('#modelId').modal('show');
    });
</script>
@endif

<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Formulár byl úspěšně odeslán.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
