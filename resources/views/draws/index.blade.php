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

</head>

<body>
<form id="submit-draw" action="{{ route("admin.tournament.draw.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-12" style="display: flex; justify-content: space-around;
    margin-bottom: 55px;
    align-items:center">
        <input type="hidden" name="tournament_id" value="{{ request()->tournament}}">
        <div class="form-group">
            <label for="draw-name" class="form-label">Name</label>
            <input required id="draw-name" name="name" type="text"
                   class="form-control">
        </div>
        <div class="form-group">
            <label for="category" class="form-label">Category*</label>

            <select id="category" required name="category_id" class="form-control">
                <option value="">Choose Category</option>
                @foreach($category_list  as $category)
                    <option
                        value="{{$category->code}}">{{$category->name}}</option>
                @endforeach

            </select>
        </div>


        <div class="form-group">
            <label for="gender" class="form-label">Gender*</label>

            <select required id="gender" name="gender" class="form-control">
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
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script>
    $(function () {
        // Add round input
        $('.round').each(function () {
            const round = this;
            $(this).prepend($('<input/>', {type: 'hidden', name: `bracket[${round.id}]`, id: this.id}))
            $('.ip-box  input', this).each(function () {
                const player = this;
                const playerId = `${round.id}-${player.id}`;
                $(this).attr({'name': `bracket[${playerId}]`, "data-pid": playerId})
            })
        });

        $('#draw-name').on('keyup', function (e) {
            //alert("key up");
            e.preventDefault();
            let str = $(this).val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            str = str.replace(/\W$/, '-').toLowerCase();
            $('#draw-name').val(str);
        });


        $('form#submit-draw').submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            const form = $(this);
            const url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    if (data.status === '1') {
                        parent.location.reload();

                    }
                    console.log(data); // show response from the php script.
                }
            });


        });
    });

</script>
</body>

</html>
