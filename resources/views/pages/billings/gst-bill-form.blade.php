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
        <h4>GST Billing Form</h4>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{ route('gst.billings.form.store') }}" method="POST">
                    @csrf
                    {{-- <div class="form-group">
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
                    </div> --}}
                    
                    <div class="form-group">
                        <label>Invoice Date</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                             <i class="fa-solid fa-calendar-days"></i>
                            </div>
                          </div>
                          <input type="date" class="form-control" name="invoice_date" value="{{ old('invoice_date') }}" placeholder="Please select date">
                          @if ($errors->has('invoice_date'))
                            <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('invoice_date')}}</div>
                          @endif
                        </div>
                    </div>
                   
                    <div class="form-group">
                      <label>Invoice No</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-receipt"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="invoice_no" value="{{ old('invoice_no') }}" placeholder="Please enter invoice number">
                        @if ($errors->has('invoice_no'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('invoice_no')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Item Description</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-address-book"></i>
                          </div>
                        </div>
                        <textarea name="item_description" id="item_description" cols="30" rows="10">Please enter description</textarea>
                        @if ($errors->has('item_description'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('item_description')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Total Amount</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-arrow-up-wide-short"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="total_amount" value="{{ old('total_amount') }}" placeholder="Please enter amount">
                        @if ($errors->has('total_amount'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('total_amount')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>CGST Rate</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-percent"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="cgst_rate" value="{{ old('cgst_rate') }}" placeholder="Please enter CGST rate">
                        @if ($errors->has('cgst_rate'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('cgst_rate')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>SGST Rate</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-percent"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="sgst_rate" value="{{ old('sgst_rate') }}" placeholder="Please enter SGST rate">
                        @if ($errors->has('sgst_rate'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('sgst_rate')}}</div>
                        @endif
                      </div>
                    </div>


                    <div class="form-group">
                      <label>IGST Rate</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                          <i class="fa-solid fa-percent"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="igst_rate" value="{{ old('igst_rate') }}" placeholder="Please enter IGST rate">
                        @if ($errors->has('igst_rate'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('igst_rate')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>CGST Amount</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-dollar-sign"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="cgst_amount" value="{{ old('cgst_amount') }}" placeholder="Please enter CGST Amount">
                        @if ($errors->has('cgst_amount'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('cgst_amount')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>SGST Amount</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-dollar-sign"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="sgst_amount" value="{{ old('sgst_amount') }}" placeholder="Please enter SGST Amount">
                        @if ($errors->has('sgst_amount'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('sgst_amount')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>IGST Amount</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-dollar-sign"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="igst_amount" value="{{ old('igst_amount') }}" placeholder="Please enter IGST Amount">
                        @if ($errors->has('igst_amount'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('igst_amount')}}</div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tax Amount</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                           <i class="fa-solid fa-money-check-dollar"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="tax_amount" value="{{ old('tax_amount') }}" placeholder="Please enter tax amount">
                        @if ($errors->has('tax_amount'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('tax_amount')}}</div>
                        @endif
                      </div>
                    </div> 


                    <div class="form-group">
                      <label>Net Amount</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-money-check-dollar"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="net_amount" value="{{ old('net_amount') }}" placeholder="Please enter net amount">
                        @if ($errors->has('net_amount'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('net_amount')}}</div>
                        @endif
                      </div>
                    </div> 


                    <div class="form-group">
                      <label>Declaration</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa-solid fa-code-branch"></i>-
                          </div>
                        </div>
                        <textarea name="declaration" id="declaration" cols="30" rows="10">Please enter declaration</textarea>
                        @if ($errors->has('declaration'))
                          <div class="text-danger font-weight-bolder d-block mb-2">{{ $errors->first('declaration')}}</div>
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

