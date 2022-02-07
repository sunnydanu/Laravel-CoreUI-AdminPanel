@extends('layouts.app')
@section('content')

    @php
        $catList = [];
            foreach($category_list as $category){
            $catList[$category->code] = trim($category->name);
            }

    @endphp
    <div class="card">
        <div class="card-header">
            <div class="box-form-header">

                <div class="box-form-title h2">Player Register</div>
                <div class="box-form-text"></div>
            </div>
        </div>

        <div class="card-body">


            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" onclick="$('#error').hide()" data-bs-dismiss="alert">x
                    </button>
                    <strong id="error">
                        {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
                    </strong>
                </div>
            @endif
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
                                                    <label class="form-label">Your name<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="full_name" type="text"
                                                           name="full_name" placeholder="Your name" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Father's Name<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="father_name" type="text"
                                                           name="father_name" placeholder="Father's Name" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Mother's Name<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="mother_name" type="text"
                                                           name="mother_name" placeholder="Mother's Name" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Gender<span
                                                            class="text-danger">*</span></label>

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
                                                    <label class="form-label">DOB<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="dob" type="date" name="dob"
                                                           placeholder="DOB" required="">
                                                </div>
                                            </div>
                                            <div class="col-12" id="category">
                                                <div class="form-group">
                                                    <label class="form-label">Category<span class="text-danger">*</span></label>
                                                    <input type="hidden" class="cat-code" name="category">
                                                    <span class="text-danger cat-name"></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">District<span class="text-danger">*</span></label>

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
                                                    <label class="form-label">Address<span class="text-danger">*</span></label>
                                                    <input class="form-control" id="address" type="text" name="address"
                                                           placeholder="Your Address" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Pincode<span class="text-danger">*</span></label>
                                                    <input class="form-control" id="pincode" type="text" name="pincode"
                                                           placeholder="Pincode" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Phone No.<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="phone" type="text" name="phone"
                                                           placeholder="Phone No." required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Email<span
                                                            class="text-danger">*</span></label>
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
                                                    <label class="form-label">Player image<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="player_image" type="file"
                                                           accept=".jpeg,.jpg,.png" name="player_image"
                                                           placeholder="Player Image" required="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">DOB Certificate<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="dob_crt" type="file"
                                                           accept=".jpeg,.jpg,.png" name="dob_crt"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>

        let catList = JSON.parse('<?= json_encode($catList)?>');


        $("#dob").on('blur', function () {
            const age = Math.floor((new Date() - new Date(this.value)) / (365.25 * 24 * 60 * 60 * 1000));

            if (age) {
                let cat = 'U-';
                if (age > 19) {
                    cat += 19;
                } else if (age > 17) {
                    cat += 17;
                } else if (age > 15) {
                    cat += 15;
                } else if (age > 13) {
                    cat += 13;
                } else if (age > 11) {
                    cat += 11;
                }
                $('#category .cat-code').val(cat);
                $('#category .cat-name').html(catList[cat]);
            }
        });


        $("input[type='file']").on("change", function () {

            const fileExtension = ['png', 'jpeg', 'jpg'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only 'png', 'jpeg', 'jpg' format is allowed.");
                this.value = ''; // Clean field
                return false;
            }

            if (this.files[0].size > 2000000) {
                alert("Please upload file less than 2MB. Thanks!!");
                $(this).val('');
            }
        })
    </script>
@endsection
