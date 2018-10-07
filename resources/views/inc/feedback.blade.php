@if (session('success'))
    <div class="alert alert-success alert-dismissible show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ session('success') }}</strong>
    </div>
@endif
@if (session('failure'))
    <div class="alert alert-danger alert-dismissible show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ session('failure') }}</strong>
    </div>
@endif
@if (session('finded'))
    <div class="alert alert-danger alert-dismissible show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ session('finded') }}</strong>
    </div>
@endif