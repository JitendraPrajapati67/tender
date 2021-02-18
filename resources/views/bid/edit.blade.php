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
                            @if($tender->status == 0)
                              Inactive
                            @else
                              Active
                            @endif
                            
                        </td>
                    </tr>
                     <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.type') }}
                        </th>
                        <td>
                            @if($tender->type ==0)
                                Free
                            @else
                                Paid
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.created_by') }}
                        </th>
                        <td>
                            @if($tender->created_by == 1)
                                Admin
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class='form-group'>
            <label class="" style="margin-left: 25px;">Materials:-</label>  
              @foreach($materials as $key => $label)
                <label class="" style="margin-left: 25px;">{{ $label->category_name }}</label>
              @endforeach  
            </div>
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
        {{ trans('global.edit') }} {{ trans('cruds.bidManagement.title') }}
    </div>

    <div class="card-body">
         <form method="POST" action="{{ route("bid.update", [$Bid->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.bidManagement.fields.price') }}</label>
                <input onkeypress="return blockSpecialChar(event)"  class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', $Bid->price ) }}" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>            
            <div class="form-group">
                <label class="required" for="discription">{{ trans('cruds.bidManagement.fields.description') }} {{ trans('cruds.tenderManagement.fields.description_helper') }}</label>
                <input class="form-control {{ $errors->has('discription') ? 'is-invalid' : '' }}" type="text" name="discription" id="discription" value="{{ old('discription', $Bid->discription) }}" required>
                @if($errors->has('discription'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discription') }}
                    </div>
                @endif
            </div>
            <div class='form-group'>
                @foreach($tenderdocument as $key => $label)
                    <label>{{ $label->document_orignal_name }}</label> <a style="color:white;" id='{{$label->id}}' class="btn btn-xs btn-danger remove-doc">Remove</a></br>
                @endforeach
            </div>
            <div class="form-group">
                <input type='hidden' value='{{$Bid->tender_id}}' id='tender_id' name='tender_id'>
                <input type='hidden' value='{{$Bid->bidder_id}}' id='bidder_id' name='bidder_id'>
                <input type='hidden' value='{{$Bid->id}}' id='id' name='id'> 
                
                <label class="required" for="document">{{ trans('cruds.bidManagement.fields.document') }}</label>    
                <br>
                <input class=" {{ $errors->has('document') ? 'is-invalid' : '' }}" type="file" name="document[]" id="document" multiple="multiple" value="" >
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
    $(".remove-doc").click(function(event){
      event.preventDefault();
      var id = $(this).attr('id');
      
            
      swal({
        title: '',
        text: '{{ trans('global.areYouSure') }}',
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: "{{ route('admin.tender.destroyDocument') }}",
          data: { id: id, _method: 'DELETE' }})
          .done(function () { 
            location.reload() 
        });


        } 
      });
  });
});
</script>
@endsection


