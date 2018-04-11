@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of contacts
                    <a href="{{ route('contact.create') }}">
                        <button class="btn btn-success">Create new contact</button>
                    </a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="list-group">
                            <div class="row">
                                <div class="col-md-12">
                                @forelse($contacts as $contact)
                                        <a href="{{ route('contact.show', $contact->id) }}" class="list-group-item list-group-item-action">
                                            {{ $contact->full_name }}
                                        </a>
                                @empty
                                    Empty list
                                @endforelse
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <br/>
            {{ $contacts->render() }}
        </div>
    </div>
</div>
@endsection