@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Contact information</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Name:</label>
                                {{ $contact->name }}
                            </div>
                            <div class="col-md-4">
                                <label for="name">Surname:</label>
                                {{ $contact->surname }}
                            </div>
                            <div class="col-md-4">
                                <label for="name">E-mail:</label>
                                {{ $contact->email }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Phone:</label>
                                {{ $contact->phone }}
                            </div>
                            <div class="col-md-4">
                                <label for="name">Birth:</label>
                                {{ $contact->birth }}
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-1 text-left">
                                <a href="{{ route('contact.edit', $contact->id) }}"><button class="btn btn-success">Edit</button></a>
                            </div><div class="col-md-2 text-left">
                                <a href="{{ route('contact.destroy', $contact->id) }}"><button class="btn btn-danger delete">Delete</button></a>
                            </div>
                            <div class="col-md-9 text-right">
                                <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            $('.btn.btn-danger.delete').on('click', function(e){
                e.preventDefault();
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Contact has been deleted!", {
                            icon: "success",
                        });
                        var _token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'POST',
                            method: 'DELETE',
                            data: {_token:_token},
                            url: '{!! route("contact.destroy", $contact->id) !!}',
                            success: function (data) {

                            }
                        });
                    }
                });
            });
        </script>
    @endsection
@endsection
