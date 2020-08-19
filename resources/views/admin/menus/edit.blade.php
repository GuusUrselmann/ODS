@extends('adminlte::page')
@section('title', 'Product bewerken')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Menu Bewerken</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formMenuEdit" class="form-menu-edit needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Naam</label>
                                <input type="text" class="form-control" placeholder="Naam" name="name" value="{{$menu->name}}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="menu-builder col-12">
                                <div class="row">

                                    <div class="builder-menu col-9">
                                        <div class="builder-item">
                                            Item 1
                                        </div>
                                        <div class="builder-item">
                                            Item 2
                                        </div>
                                        <div class="builder-item">
                                            Item 3
                                        </div>
                                        <div class="builder-element">
                                            Food item
                                        </div>
                                        <div class="builder-element">
                                            Title
                                        </div>
                                    </div>

                                    <div class="builder-elements col-3">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formMenuEdit" class="form-menu-edit-submit btn btn-lg btn-success mb-2">Bewerken</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.js"></script>
<script>
    // const sortable = new Draggable.Sortable(
    //     document.querySelector('.builder-menu'), {
    //         draggable: '.builder-item',
    //     }
    // )
    $(document).ready(function() {
        const drop = new Draggable.Droppable(document.querySelector('.menu-builder'), {
            draggable: '.builder-element',
            dropzone: '.builder-menu',
        });
    });
    // sortable.on('sortable:start', () => {
    //     console.log('sortable:start')
    // })
    // sortable.on('sortable:sort', () => {
    //     console.log('sortable:sort')
    // })
    // sortable.on('sortable:sorted', () => {
    //     console.log('sortable:sorted')
    // })
    // sortable.on('sortable:stop', () => {
    //     console.log('sortable:stop')
    // })
</script>
    <script>
    $(document).ready(function() {
        $(".categories-select").select2({
            tags: true,
            closeOnSelect: false,
            width: '80%'
        });
        $('#image-upload').on('click', function() {
            $('#image-input').click();
        });
        $('#image-input').on('change', function(e) {
            if(e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".form-image-preview img").attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
    </script>
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
