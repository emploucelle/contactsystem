@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">Dashboard</div> -->

                <center  style="padding:5%;">
                    <h1>Thank you for registering</h1>
                    <a href="{{ url('/contacts') }}" class="btn btn-success">continue</a>
                </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
