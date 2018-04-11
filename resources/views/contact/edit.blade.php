@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit contact</div>
                   <div class="col-md-12 text-center">
                        <div class="alert alert-success" style="display: none;">
                            Successfully updated
                        </div>
                        <div class="alert alert-danger" style="display: none;">

                        </div>
                   </div>
                    <div class="card-body">
                        <form action="{{ route('contact.update', $contact->id) }}" method="POST" id="c-form" onsubmit="return false;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" required class="form-control" value="{{ $contact->name or ''}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Surname:</label>
                                    <input type="text" name="surname" required class="form-control" value="{{ $contact->surname or ''}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="name">E-mail:</label>
                                    <input type="text" name="email" required class="form-control email" value="{{ $contact->email or ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Phone:</label>
                                    <input type="text" name="phone" required class="form-control" value="{{ $contact->phone or ''}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Birth:</label>
                                    <input type="date" name="birth" class="form-control" value="{{ $contact->birth or ''}}">
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-success c-save">Save</button>
                                </div>
                            </div>
                            @method('PATCH')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".c-save").on('click', function(e){
                e.preventDefault();
                var form = $('#c-form');

                $.ajax({
                    type:'POST',
                    url:'{!! route("contact.update", $contact->id) !!}',
                    data: form.serialize(),
                    success:function(data){
                        if(data.success == true) {
                            $('.alert.alert-danger').fadeOut();
                            $('.form-control.email').removeClass('is-invalid');
                            $('.alert.alert-success').fadeIn(400)
                                .delay(2000)
                                .fadeOut(600);
                        } else {
                            $('.alert.alert-danger').text(data);
                            $('.alert.alert-danger').fadeIn(400);
                            $('.form-control.email').addClass('is-invalid');
                        }
                    }
                });
            });
        </script>
    @endsection
@endsection
