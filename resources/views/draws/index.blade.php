<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="{{ asset('css/bracket.css') }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Girls Single</title>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
</head>

<body>
<form action="{{ route("admin.tournament.draw.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-12" style="display: flex; justify-content: space-around;
    margin-bottom: 55px;
    align-items:center">
        <div class="form-group">
            <label for="category" class="form-label">Category*</label>

            <select id="category" name="category" class="form-control">
                <option value="">Choose Category</option>
                @foreach($category_list  as $category)
                    <option
                        value="{{$category->code}}">{{$category->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="gender" class="form-label">Gender*</label>

            <select id="gender" name="gender" class="form-control">
                <option value="">Choose gender</option>
                <option value="men">Men</option>
                <option value="women">Women</option>

            </select>
        </div>
        <div class="form-group">


            <button class="btn btn-success " style=" width: 130px;margin-top: 30px; "
                    id="submit" type="submit">
                {{ trans('global.save') }}</button>
        </div>
    </div>

    <hr style="width: 98%;">
    @include('draws.draw-'.request('draw'))

</form>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
</body>

</html>
