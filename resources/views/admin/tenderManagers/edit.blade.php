@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tenderManagement.title_singular') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.tender.update", [$tender->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tender_reference_no">{{ trans('cruds.tenderManagement.fields.tender_reference_no') }}</label>
                <input onkeypress="return blockSpecialChar(event)" class="form-control {{ $errors->has('tender_reference_no') ? 'is-invalid' : '' }}" type="text" name="tender_reference_no" id="tender_reference_no"  value="{{ old('tender_reference_no', $tender->tender_reference_no) }}"  required>
                @if($errors->has('tender_reference_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tender_reference_no') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required" for="category_code">{{ trans('cruds.tenderManagement.fields.tender_title') }}</label>
                <input onkeypress="return blockSpecialChar(event)" class="form-control {{ $errors->has('tender_title') ? 'is-invalid' : '' }}" type="text" name="tender_title" id="tender_title"  value="{{ old('tender_title', $tender->tender_title) }}"  required>
                @if($errors->has('tender_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tender_title') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="tender_discription">{{ trans('cruds.tenderManagement.fields.description') }} {{ trans('cruds.tenderManagement.fields.description_helper') }}</label>
                <textarea class="form-control {{ $errors->has('tender_discription') ? 'is-invalid' : '' }}" name="tender_discription" id="tender_discription"   required>
                {{ old('tender_discription', $tender->tender_discription) }}
                </textarea>
                @if($errors->has('tender_discription'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tender_discription') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required" for="open_date">{{ trans('cruds.tenderManagement.fields.open_date') }} </label>
                <input onkeypress="return blockSpecialChar(event)" class="form-control open_date {{ $errors->has('open_date') ? 'is-invalid' : '' }}" type="text" name="open_date" id="open_date"  value="{{ old('open_date', $tender->open_date) }}"  required>
                @if($errors->has('open_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('open_date') }}
                    </div>
                @endif
               
            </div>


            <div class="form-group">
                <label class="required" for="close_date">{{ trans('cruds.tenderManagement.fields.close_date') }}</label>
                <input onkeypress="return blockSpecialChar(event)" class="form-control close_date {{ $errors->has('close_date') ? 'is-invalid' : '' }}" type="text" name="close_date" id="close_date" value="{{ old('close_date', $tender->close_date) }}" required>
                @if($errors->has('close_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('close_date') }}
                    </div>
                @endif
               
            </div>
            
            <div class="form-group">
                <label class="">{{ trans('cruds.tenderManagement.fields.category_name') }}</label>
                <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id" >
                    <option value disabled {{ old('category_id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                   
                    @foreach($tenderCategory as $key => $label)


                        <option value="{{ $label->id }}" {{ old('category_id', '') === (string) $label->id ? 'selected' : '' }}>{{ $label->category_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_id') }}
                    </div>
                @endif
               
            </div>
            
            @foreach($material_array as $key => $label)
                
                    <label class="">{{ $key }} :- </label>

                    @foreach($label as $key2 => $label2)
                    
                        <input style='margin-left: 5px;' value='{{ $label2['id']  }}' class="form-check-input" type="checkbox" name="material[]" id="material" />
                        <label class="" style="margin-left: 25px;">{{ $label2['category_name']  }}</label> 
                    @endforeach
                    </br>
                
            </br>
            @endforeach

            <div class="form-group">
                <label class="">{{ trans('cruds.tenderManagement.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" >
                    <option value="0">Deactive</option>
                    <option value="1">Active</option>
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.tenderManagement.fields.type') }}</label>
                 <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" >
                    <option value="0">Free</option>
                    <option value="1">Paid</option>
                </select>
            </div>
            <div class='form-group'>
                @foreach($tenderdocument as $key => $label)
                    <label>{{ $label->document_orignal_name }}</label> <a style="color:white;" id='{{$label->id}}' class="btn btn-xs btn-danger remove-doc">Remove</a></br>
                @endforeach
            </div>
            <div class="form-group">
                <label class="required" for="document">{{ trans('cruds.tenderManagement.fields.document') }} </label>
                
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
                <input type='hidden' value='{{ $tender->id }}' name='tender_id'> 
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
        })

        } 
      });
  });
$('.add_more').click(function(e){
    filecount++;
    if(filecount  > 1){
        $('.remove').show();
    }
    e.preventDefault();
    $('.filediv').append('<div class="form-group"><input class="" type="file" name="document[]" id="document"  value="" required><a style="color:white;" class="btn btn-xs btn-danger remove ">Remove</a></div>');
});
$('#material_name').on('change', function(){
    $('.material_div').html('');
    $('.material_div').removeClass('hide');
    var id = $(this).val();       
    var material='';
    $.each(sites, function(key,val) {
        if(id==val.parent){
            material+='<div class="form-check"><input class="form-check-input" type="checkbox" name="material[]" id="material" value="'+val.id+'"><label class="form-check-label" for="material">'+val.category_name+'</label></div>';
        }
    });
    $('.material_div').html(material);
});
$('.open_date').datetimepicker({
    format: 'YYYY-MM-DD',
    locale: 'en',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

$('.close_date').datetimepicker({
    format: 'YYYY-MM-DD',
    locale: 'en',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })
  $('.close_date').datetimepicker({format: 'yyyy-mm-dd hh:mm'});
   });
</script>
@endsection