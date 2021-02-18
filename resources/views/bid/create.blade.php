@extends('layouts.admin')
@section('content')


<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tenderManagement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tender-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.tender_reference_no') }}
                        </th>
                        <td>
                            {{ $tender->tender_reference_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.tender_title') }}
                        </th>
                        <td>
                            {{ $tender->tender_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.description') }}
                        </th>
                        <td>
                             {{ $tender->description?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.open_date') }}
                        </th>
                        <td>
                            {{ $tender->open_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.close_date') }}
                        </th>
                        <td>
                            {{ $tender->close_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.status') }}
                        </th>
                        <td>
                            {{ $tender->status }}
                        </td>
                    </tr>
                     <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.type') }}
                        </th>
                        <td>
                            {{ $tender->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.created_by') }}
                        </th>
                        <td>
                            {{ $tender->created_by }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class='form-group'>
                @foreach($tenderMapDocument as $key => $label)
                    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> {{ $label->document_orignal_name }}</button>
                @endforeach
            </div>
            
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bidManagement.title') }}
    </div>

    <div class="card-body">
        <form method="POST" id='bid-from' action="{{ route("bid.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.bidManagement.fields.price') }}</label>
                <input onkeypress="return blockSpecialChar(event)"  class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', '') }}" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>            
            <div class="form-group">
                <label class="required" for="discription">{{ trans('cruds.bidManagement.fields.description') }} {{ trans('cruds.tenderManagement.fields.description_helper') }}</label>
                <textarea class="form-control {{ $errors->has('discription') ? 'is-invalid' : '' }}" type="text" name="discription" id="discription"  required></textarea>
                @if($errors->has('discription'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discription') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                
                <input type='hidden' value='{{$tender->id}}' id='tender_id' name='tender_id'>
                
                <label class="required" for="document">{{ trans('cruds.bidManagement.fields.document') }}</label>    
                <br>
                <input class=" {{ $errors->has('document') ? 'is-invalid' : '' }}" type="file" name="document[]" id="document" multiple="multiple" value="" required>
               <a style="color:white;display:none;" class="btn btn-xs btn-danger remove  " >Remove</a>
                @if($errors->has('document'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document') }}
                    </div>
                @endif
            </div>

            <div class='filediv'>
            </div>
            <div class="form-group">   
             <button class="btn btn-sm btn-danger  add_more ">Add More Files</button>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script type="text/javascript">
function blockSpecialChar(e) {
var k = e.keyCode;
return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8   || (k >= 48 && k <= 57));
}
   var filecount= 1;
   $(document).ready(function() {
    $("#document").change(function () {
        var fileExtension = ['docx', 'xml', 'doc', 'pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            
            swal({
            title: '',
            text: "Only formats are allowed : "+fileExtension.join(', '),
            icon: "warning",
            buttons: true,
            dangerMode: true,
          });
        $(this).val("");
        }
    });
    $("#bid-from").validate();

    $(document).on('click','.remove',function(e){
        filecount--;
        if(filecount  < 2){
            $('.remove').hide();
        }
        $(this).closest('div').remove();
        
    });
    $('.add_more').click(function(e){
        filecount++;
        if(filecount  > 1){
            $('.remove').show();
        }
        e.preventDefault();
        $('.filediv').append('<div class="form-group"><input class="" type="file" name="document[]" id="document"  value="" required><a style="color:white;" class="btn btn-xs btn-danger remove ">Remove</a></div>');
        
    });
});
</script>
@endsection


