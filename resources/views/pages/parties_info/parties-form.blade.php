@extends('layouts.app')

@section('user-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
        });
    </script>
@elseif (session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
        });
    </script>
@endif
<div class="section-body">
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h4>Party Create Form</h4>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{ route('parties.form.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Email</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-envelope"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Please enter email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Parties Type</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
                        {{-- <select class="form-control" name="parties_type">
                            <option value="" selected disabled>Please select parties option</option>
                            @foreach ($parties_type as $party_type)
                                <option value="{{ $party_type }}">{{ $party_type }}</option>
                            @endforeach
                        </select> --}}
                        @if ($errors->has('parties_type'))
                            <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('parties_type')}}</div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-key"></i>
                          </div>
                        </div>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Please enter password">
                      </div>
                    </div> 
                    
                    <div class="form-group mt-5">
                      <button type="submit" class="btn btn-primary ps-4 pe-4">Create</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
    </div>
</div>
</div>
@endsection

