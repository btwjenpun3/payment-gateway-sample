@extends('master.layout')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Outline Buttons</h3>
            </div>
            <div class="card-body">
                <p>Use <code>.btn-outline-*</code> class for outline buttons.
                </p>
                <div class="row g-2 align-items-center">
                    <div class="col-12 col-xl-2 font-weight-semibold">Normal</div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl py-3">
                        <a href="{{ route('get.balance') }}" class="btn btn-outline-primary">
                            Test API
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl py-3">
                        <a href="{{ route('checkout') }}" class="btn btn-outline-primary">
                            Test Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
