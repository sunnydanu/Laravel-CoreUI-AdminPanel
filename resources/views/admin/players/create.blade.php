@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="box-form-header">

                <div class="box-form-title h2">Player Register</div>
                <div class="box-form-text"></div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('player.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="section-md bg-transparent">
                    <div class="container">
                        <div class="row row-content">
                            <div class="col-md-12">
                                <div class="box box-form box-form-tertiary ">

                                    <div class="box-form-body box-form-body-primary">
                                        <div class="row row-15 row-gutters-14">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Your name*</label>
                                                    <input class="form-control" id="full_name" type="text"
                                                           name="full_name" placeholder="Your name" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Father's Name*</label>
                                                    <input class="form-control" id="father_name" type="text"
                                                           name="father_name" placeholder="Father's Name" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Mother's Name*</label>
                                                    <input class="form-control" id="mother_name" type="text"
                                                           name="mother_name" placeholder="Mother's Name" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Gender*</label>

                                                    <select required="" class="form-control" id="gender" type="text"
                                                            name="gender">
                                                        <option value="" selected>Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>

                                                    {{--<input class="form-control" id="gender" type="text" name="gender"--}}
                                                    {{--placeholder="Gender" required="">--}}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">DOB*</label>
                                                    <input class="form-control" id="dob" type="date" name="dob"
                                                           placeholder="DOB" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Category*</label>

                                                    <select id="category" name="category" class="form-control">
                                                        <option value="">Choose Category</option>
                                                        @foreach($category_list  as $category)
                                                            <option
                                                                value="{{$category->code}}">{{$category->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">District*</label>

                                                    <select id="district" name="district" class="form-control">
                                                        <option value="">Choose District</option>
                                                        @foreach($district_list  as $district)
                                                            <option
                                                                value="{{$district->code}}">{{$district->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Address*</label>
                                                    <input class="form-control" id="address" type="text" name="address"
                                                           placeholder="Your Address" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Pincode*</label>
                                                    <input class="form-control" id="pincode" type="text" name="pincode"
                                                           placeholder="Pincode" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Phone No.*</label>
                                                    <input class="form-control" id="phone" type="text" name="phone"
                                                           placeholder="Phone NO." required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Email</label>
                                                    <input class="form-control" id="email" type="text" name="email"
                                                           placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">T-Shirt Size</label>
                                                    <input class="form-control" id="tshirt_size" type="text"
                                                           name="tshirt_size" placeholder="T-shirt Size">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Short Size</label>
                                                    <input class="form-control" id="short_size" type="text"
                                                           name="short_size" placeholder="Short Size">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">TrackSuit Size</label>
                                                    <input class="form-control" id="tracksuit_size" type="text"
                                                           name="tracksuit_size" placeholder="Tracksuit Size">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Shoe Size</label>
                                                    <input class="form-control" id="shoe_size" type="text"
                                                           name="shoe_size" placeholder="Shoe Size">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Player image</label>
                                                    <input class="form-control" id="player_image" type="file"
                                                           name="player_image" placeholder="Player Image" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">DOB Certificate</label>
                                                    <input class="form-control" id="dob_crt" type="file" name="dob_crt"
                                                           placeholder="Certificate Image" required="">
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <button name="submit" class="btn btn-block btn-success"
                                                        value="submit">Register
                                                </button>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </form>
        </div>
    </div>

@endsection
