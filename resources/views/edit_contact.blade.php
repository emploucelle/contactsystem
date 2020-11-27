@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <h2>Contacts</h2>
                <form action = "/save_update" method = "post">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    @foreach($contacts as $contact)
                    <input type="hidden" name="id" value="{!! $contact->id !!}">
                        <table>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" value="{!! $contact->name !!}"></td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td><input type="text" name="company" value="{!! $contact->company !!}"></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><input type="text" name="phone" value="{!! $contact->phone !!}"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="email" name="email" value="{!! $contact->email !!}"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Update" class="btn btn-danger"></td>
                            </tr>
                        </table>
                    @endforeach
                </form>
        </div>
    </div>

</div>


@endsection
