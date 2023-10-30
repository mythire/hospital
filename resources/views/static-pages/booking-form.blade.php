@extends('layouts.staticmain')

@section('title', 'Book an Appointment')


@push('styles')
<style type="text/css">

    .filter .appointment-input {
        width: 100%;
        background: #fff;
        border-radius: 5px;
        border: 1px solid #eee;
        padding: 0 25px;
        height: 55px;
        appearance: none;
        font-size: 14px;
        color: #888;
        font-weight: 400;
    }
    .logasMemberArea {
        background-color: #49b0c1;
        margin: -15px -15px 20px;
        padding: 20px;
        border-radius: 5px 5px 0 0;
        position: relative;
    }
    .orOption {
        position: absolute;
        background-color: #fff;
        color: #49b0c1;
        border-radius: 50%;
        padding: 6px 8px;
        border: 3px solid;
        left: 50%;
        -webkit-transform: translate(-50%);
        transform: translate(-50%);
    }
    .appointment-input {
        width: 100%;
        background: #fff;
        border-radius: 5px;
        /*border: none;*/
        padding: 0 25px;
        padding-right: 45px;
        height: 55px;
        font-size: 14px;
        border: 1px solid #eee;
        font-weight: 400;
        color: #666;
    }
    .payment-details span {
        float: right;
    }
    .total-payment-details {
        font-size: 14px;
        font-weight: 600;
        color: #3b647e;
        border-top: 1px solid #e2e2e2;
        padding: 15px 0;
        margin-bottom: 0;
    }
    .map-container {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .map {
        flex: 1;
        background: #f0f0f0;
    }

    .info {
        padding: 1rem;
        margin: 0;
    }

    .info.error {
        color: #fff;
        background: #dc3545;
    }
</style>
@endpush

@section('content')
<div class="page-title-area style-four " style="background-image: url('/images/page-title/telemed.png');">
    <div class="container">
        <div class="page-title-content text-start">
            <h2>Schedule an Appointment</h2>
            <ul>
                <li><a href="/">Home</a></li>
                <li>Schedule an Appointment</li>
            </ul>
        </div>
    </div>
</div>

<section class="contact-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <div class="contact-form">

                    @livewire('create-appointment')

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')


@endpush
