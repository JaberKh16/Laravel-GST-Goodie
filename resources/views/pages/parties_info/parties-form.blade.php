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
                        <label>Fullname</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fa-solid fa-person-half-dress"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" placeholder="Please enter fullname">
                          @if ($errors->has('fullname'))
                            <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('fullname')}}</div>
                          @endif
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
                         <select class="form-control" name="parties_type_id" id="parties_type_id">
                            <option value="" selected disabled>Please select parties option</option>
                            @foreach ($parties_type as $party_id => $party_type)
                                <option value="{{ $party_id }}">{{ $party_type }}</option>
                            @endforeach
                         </select>
                        @if ($errors->has('parties_type'))
                            <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('parties_type')}}</div>
                        @endif
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label>Contact No</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-phone"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="contact" value="{{ old('contact') }}" placeholder="Please enter phone number">
                        @if ($errors->has('contact'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('contact')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Self Address</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-address-book"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Please enter address">
                        @if ($errors->has('address'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('address')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Account Holder Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-file-invoice"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="account_holder_name" value="{{ old('account_holder_name') }}" placeholder="Please enter account holder name">
                        @if ($errors->has('account_holder_name'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('account_holder_name')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Account No</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-address-card"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="account_no" value="{{ old('account_no') }}" placeholder="Please enter account number">
                        @if ($errors->has('account_no'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('account_no')}}</div>
                        @endif
                      </div>
                    </div>

                     <div class="form-group">
                      <label>Bank Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-building-columns"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}" placeholder="Please enter bank name">
                        @if ($errors->has('bank_name'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('bank_name')}}</div>
                        @endif
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label>IFSC Code</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-key"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="ifsc_code" value="{{ old('ifsc_code') }}" placeholder="Please enter code">
                        @if ($errors->has('ifsc_code'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('ifsc_code')}}</div>
                        @endif
                      </div>
                    </div> 

                    <div class="form-group">
                      <label>Branch Address</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-code-branch"></i>-
                          </div>
                        </div>
                        <input type="text" class="form-control" name="branch_address" value="{{ old('branch_address') }}" placeholder="Please enter branch address">
                        @if ($errors->has('branch_address'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('branch_address')}}</div>
                        @endif
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

