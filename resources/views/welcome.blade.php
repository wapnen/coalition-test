@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Product') }}</div>

                <div class="card-body">
                    <form id = "product-form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Quantity in stock') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity">

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Price per item') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" placeholder="0.00" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="submit" class="btn btn-primary">
                                    {{ __('Add product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>


    <div class="row justify-content-center mt-5">
        <div class="col-md-12">


            <div class="card">
                <div class="card-header">{{ __('All Products') }}</div>

                <div class="card-body table-responsive">
                  <table class="table table-striped ">
                      <thead>
                        <tr>

                          <th>Product name</th>
                          <th>Quantity in Stock</th>
                          <th>Price per item</th>
                          <th>Datetime submitted</th>
                          <th>Total value number</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody id="products">


                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id = "product-form" method="POST" action="">
            @csrf
            <input type="hidden" name="edit-id" id="edit-id" value="">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                <div class="col-md-6">
                    <input id="edit-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="edit-quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity in stock') }}</label>

                <div class="col-md-6">
                    <input id="edit-quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity">

                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Price per item') }}</label>

                <div class="col-md-6">
                    <input id="edit-price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price"  placeholder="0.00" required autocomplete="price" autofocus required>

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" id="edit" class="btn btn-primary">
                        {{ __('Save changes') }}
                    </button>
                </div>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>
</div>
@endsection
