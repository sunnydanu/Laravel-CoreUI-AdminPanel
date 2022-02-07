@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} Player
        </div>

        <div class="card-body">
            <form action="{{ route('admin.players.update', [$player->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <section class="section-md bg-transparent">
                    <div class="container">
                        <div class="row row-content">
                            <div class="col-md-12">
                                <div class="box box-form box-form-tertiary ">

                                    <div class="box-form-body box-form-body-primary">
                                        <div class="row row-15 row-gutters-14">
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                                    <label class="form-label">Your name*</label>
                                                    <input class="form-control" id="full_name" type="text"
                                                           value="{{ old('full_name', isset($player) ? $player->full_name : '') }}"
                                                           name="full_name" placeholder="Your name" required="">
                                                    @if ($errors->has('full_name'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('full_name') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('father_name') ? 'has-error' : '' }}">
                                                    <label class="form-label">Father's Name*</label>
                                                    <input class="form-control" id="father_name" type="text"
                                                           value="{{ old('father_name', isset($player) ? $player->mother_name : '') }}"
                                                           name="father_name" placeholder="Father's Name" required="">
                                                    @if ($errors->has('father_name'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('father_name') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('mother_name') ? 'has-error' : '' }}">
                                                    <label class="form-label">Mother's Name*</label>
                                                    <input class="form-control" id="mother_name" type="text"
                                                           value="{{ old('mother_name', isset($player) ? $player->mother_name : '') }}"
                                                           name="mother_name" placeholder="Mother's Name" required="">
                                                    @if ($errors->has('mother_name'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('mother_name') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                                    <label class="form-label">Gender*</label>
                                                    <input class="form-control" id="gender" type="text" name="gender"
                                                           value="{{ old('gender', isset($player) ? $player->gender : '') }}"
                                                           placeholder="Gender" required="">
                                                    @if ($errors->has('gender'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('gender') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                                                    <label class="form-label">DOB*</label>
                                                    <input class="form-control" id="dob" type="date" name="dob"
                                                           value="{{ old('dob', isset($player) ? $player->dob : '') }}"
                                                           placeholder="DOB" required="">
                                                    @if ($errors->has('dob'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('dob') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                    <label class="form-label">Category*</label>

                                                    <select id="category" name="category" class="form-control">
                                                        <option value="">Choose Category</option>
                                                        @foreach($category_list as $category)
                                                            <option
                                                                {{ (isset($player) && $player->category === $category->code) ? 'selected' : ''  }} value="{{$category->code}}">{{$category->name}}</option>
                                                        @endforeach


                                                    </select>
                                                    @if ($errors->has('category'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('category') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('district') ? 'has-error' : '' }}">
                                                    <label class="form-label">District*</label>

                                                    <select id="district" name="district" class="form-control">
                                                        <option value="">Choose District</option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Amritsar' ? 'selected' : '' }}
                                                            value="Amritsar">Amritsar
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Barnala' ? 'selected' : '' }}
                                                            value="Barnala">Barnala
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Bathinda' ? 'selected' : '' }}
                                                            value="Bathinda">Bathinda
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Faridkot' ? 'selected' : '' }}
                                                            value="Faridkot">Faridkot
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Fatehgarh Sahib' ? 'selected' : '' }}
                                                            value="Fatehgarh Sahib">Fatehgarh Sahib
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Fazilka' ? 'selected' : '' }}
                                                            value="Fazilka">Fazilka
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Firozpur' ? 'selected' : '' }}
                                                            value="Firozpur">Firozpur
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Gurdaspur' ? 'selected' : '' }}
                                                            value="Gurdaspur">Gurdaspur
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Hoshiarpur' ? 'selected' : '' }}
                                                            value="Hoshiarpur">Hoshiarpur
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Jalandhar' ? 'selected' : '' }}
                                                            value="Jalandhar">Jalandhar
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Kapurthala' ? 'selected' : '' }}
                                                            value="Kapurthala">Kapurthala
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Khanna' ? 'selected' : '' }}
                                                            value="Khanna">Khanna
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Ludhiana' ? 'selected' : '' }}
                                                            value="Ludhiana">Ludhiana
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Mansa' ? 'selected' : '' }}
                                                            value="Mansa">Mansa
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Malerkotla' ? 'selected' : '' }}
                                                            value="Malerkotla">Malerkotla
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Moga' ? 'selected' : '' }}
                                                            value="Moga">Moga
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Mohali' ? 'selected' : '' }}
                                                            value="Mohali">Mohali
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Muktsar' ? 'selected' : '' }}
                                                            value="Muktsar">Muktsar
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Nawanshahr' ? 'selected' : '' }}
                                                            value="Nawanshahr">Nawanshahr
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Pathankot' ? 'selected' : '' }}
                                                            value="Pathankot">Pathankot
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Patiala' ? 'selected' : '' }}
                                                            value="Patiala">Patiala
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Ropar' ? 'selected' : '' }}
                                                            value="Ropar">Ropar
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Sangrur' ? 'selected' : '' }}
                                                            value="Sangrur">Sangrur
                                                        </option>
                                                        <option
                                                            {{ (isset($player) ? $player->district : '') == 'Tarn Taran' ? 'selected' : '' }}
                                                            value="Tarn Taran">Tarn Taran
                                                        </option>
                                                    </select>
                                                    @if ($errors->has('district'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('full_name') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                    <label class="form-label">Address*</label>
                                                    <input class="form-control" id="address" type="text" name="address"
                                                           placeholder="Your Address"
                                                           value="{{ old('address', isset($pincode) ? $player->address : '') }}"
                                                           required="">
                                                    @if ($errors->has('address'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('address') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('pincode') ? 'has-error' : '' }}">
                                                    <label class="form-label">Pincode*</label>
                                                    <input class="form-control" id="pincode" type="text" name="pincode"
                                                           placeholder="Pincode"
                                                           value="{{ old('pincode', isset($pincode) ? $player->pincode : '') }}"
                                                           required="">
                                                    @if ($errors->has('pincode'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('full_name') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                                    <label class="form-label">Phone No.*</label>
                                                    <input class="form-control" id="phone" type="text" name="phone"
                                                           placeholder="Phone NO."
                                                           value="{{ old('phone', isset($phone) ? $player->phone : '') }}"
                                                           required="">
                                                    @if ($errors->has('phone'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('phone') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                    <label class="form-label">Email</label>
                                                    <input class="form-control" id="email"
                                                           value="{{ old('email', isset($player) ? $player->email : '') }}"
                                                           type="text" name="email" placeholder="Email">
                                                    @if ($errors->has('email'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('email') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('tshirt_size') ? 'has-error' : '' }}">
                                                    <label class="form-label">T-Shirt Size</label>
                                                    <input class="form-control" id="tshirt_size" type="text"
                                                           value="{{ old('tshirt_size', isset($player) ? $player->tshirt_size : '') }}"
                                                           name="tshirt_size" placeholder="T-shirt Size">
                                                    @if ($errors->has('tshirt_size'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('tshirt_size') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('short_size') ? 'has-error' : '' }}">
                                                    <label class="form-label">Short Size</label>
                                                    <input class="form-control" id="short_size" type="text"
                                                           name="short_size"
                                                           value="{{ old('short_size', isset($player) ? $player->short_size : '') }}"
                                                           placeholder="Short Size">
                                                    @if ($errors->has('short_size'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('short_size') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('tracksuit_size') ? 'has-error' : '' }}">
                                                    <label class="form-label">TrackSuit Size</label>
                                                    <input class="form-control" id="tracksuit_size" type="text"
                                                           name="tracksuit_size" placeholder="Tracksuit Size"
                                                           value="{{ old('tracksuit_size', isset($player) ? $player->tracksuit_size : '') }}">
                                                    @if ($errors->has('tracksuit_size'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('tracksuit_size') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('shoe_size') ? 'has-error' : '' }}">
                                                    <label class="form-label">Shoe Size</label>
                                                    <input class="form-control" id="shoe_size" type="text"
                                                           value="{{ old('shoe_size', isset($player) ? $player->shoe_size : '') }}"
                                                           name="shoe_size" placeholder="Shoe Size">
                                                    @if ($errors->has('shoe_size'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('shoe_size') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('player_image') ? 'has-error' : '' }}">
                                                    <label class="form-label">Player image</label>
                                                    <input class="form-control" id="player_image" type="file"
                                                           name="player_image" placeholder="Player Image" required="">
                                                    @if ($errors->has('player_image'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('player_image') }}
                                                        </em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="form-group {{ $errors->has('dob_crt') ? 'has-error' : '' }}">
                                                    <label class="form-label">DOB Certificate</label>
                                                    <input class="form-control" id="dob_crt" type="file" name="dob_crt"
                                                           placeholder="Certificate Image" required="">
                                                    @if ($errors->has('dob_crt'))
                                                        <em class="invalid-feedback">
                                                            {{ $errors->first('dob_crt') }}
                                                        </em>
                                                    @endif
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
