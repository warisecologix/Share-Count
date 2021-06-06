@if(session()->has('success_message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            <li>
                {{ session()->get('success_message') }}
            </li>
        </ul>
    </div>
@endif
