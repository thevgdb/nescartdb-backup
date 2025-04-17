@if( isset($errors) && is_array($errors) && count($errors) > 0 )
    <div class="alert alert-danger">
        <p><strong>Please correct the following errors:</strong></p>
        <ol>
            @foreach( $errors as $error )
                <li>{!! $error[0] !!}</li>
            @endforeach
        </ol>
    </div>
@endif
