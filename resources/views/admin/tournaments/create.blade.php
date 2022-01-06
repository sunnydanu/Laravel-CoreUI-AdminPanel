@extends('layouts.admin')
@section('content')


    <div class="card">
        <div class="card-header">
            <div class="box-form-header">

                <div class="box-form-title h2">Tournament Register</div>
                <div class="box-form-text"></div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.tournaments.store') }}" method="POST" enctype="multipart/form-data">
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
                                                    <label class="form-label">Title*</label>
                                                    <input class="form-control" id="title" type="text" name="title"
                                                           placeholder="title" required="">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" id="description" name="description"
                                                              placeholder="Tournament details" required=""></textarea>
                                                </div>
                                            </div>


                                            <div class="col-12 mt-2">
                                                <button name="submit" class="btn btn-block btn-success"
                                                        value="submit">Create
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
