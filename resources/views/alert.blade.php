@if (session()->has('success'))
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success">
                    <div class="justify-content-sm-around">
                        <button type="button" class="close btn-sm" data-dismiss="alert">&times;</button>
                        </div>
                    {{session()->get('success')}}
                </div>
            </div>
        </div>
    </div>
        
@endif

@if (session()->has('error'))
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-danger">
                <div class="justify-content-sm-around">
                    <button type="button" class=" btn-sm close" data-dismiss="alert">&times;</button>
                    </div>
                {{session()->get('error')}}
            </div>
        </div>
    </div>
</div>
@endif