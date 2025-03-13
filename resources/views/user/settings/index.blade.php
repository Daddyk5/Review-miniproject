@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">⚙️ Account Settings</h2>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="#account" class="list-group-item list-group-item-action active" data-bs-toggle="tab">General</a>
                <a href="#password" class="list-group-item list-group-item-action" data-bs-toggle="tab">Password</a>
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <div class="tab-content">

                <!-- General Info -->
                <div class="tab-pane fade show active" id="account">
                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                        </div>
                        <button class="btn btn-primary">Save Changes</button>
                    </form>
                </div>

                <!-- Password Change -->
                <div class="tab-pane fade" id="password">
                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <button class="btn btn-primary">Change Password</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
