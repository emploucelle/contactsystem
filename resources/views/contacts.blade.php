@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- <div class="card"> -->
                <!-- <div class="card-header">Contacts</div> -->
                <h2>Your Contacts</h2>

                        <div style="float:right;">
                            <a href="" data-toggle="modal" data-target="#myModal">Add Contact</a> | <a href="{{ url('/contacts') }}">Contacts</a>
                            <form action="">
                                <div class="form-group">
                                    <input type="text" class="form-controller" id="search" name="search" placeholder="Search Here...">
                                </div>
                            </form>
                        </div>
                        
                            <table class="table">
                                <thead>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>COMPANY</th>
                                    <th>PHONE</th>
                                    <th>EMAIL</th>
                                    <th>ACTION</th>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->id}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->company}}</td>
                                        <td>{{$contact->phone}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td> <a href="{{ url('/edit_contact'.$contact->id) }}">Edit</a> | <a href="{{ url('delete_contact/'.$contact->id) }}"  onclick="return confirm('Are you sure you want to DELETE?')">Delete</a> </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                            <div style="float:center;">{{ $contacts->links() }}</div>
               
            <!-- </div> -->
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <p>Add Contact</p>
            <form action = "/save_contact" method = "post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Company</td>
                        <td><input type="text" name="company"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Add Contact"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>

    </div>
    </div>

</div>


@endsection
