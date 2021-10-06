<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('image') }}
            {{ Form::text('image', $servicio->image, ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'placeholder' => 'Image']) }}
            {!! $errors->first('image', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>