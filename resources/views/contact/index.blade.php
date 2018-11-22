@extends('home.layouts.home')

@section('content')


<div class="checkout_area section_padding_100">
    <div class="container">
        <div class="row">            
            <div class="col-12 col-md-6">
            
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-page-heading">
                        <h5>Contact</h5>
                        <p>Enter your comments</p>
                    </div>

                    {!! Form::open(['route' => 'contact.store']) !!}
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="comments">Comments <span>*</span></label>
                                {!! Form::textarea('comments', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="first_name">First Name <span>*</span></label>
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-12 mb-3">
                                <label for="last_name">Last Name <span>*</span></label>
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email">Email <span>*</span></label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                            </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email">Telephone <span>*</span></label>
                                {!! Form::number('telephone', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="col-12 mb-3">
                                <div class="custom-control custom-checkbox d-block">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Subscribe to our newsletter</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ url('/') }}" class="btn btn-default">Cancel</a>
                            </div>

                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
