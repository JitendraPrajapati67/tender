@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tenderManagement.title_singular') }}
    </div>
    <div class="card-body">
        <form method="POST" id='tender-from' action="{{ route("admin.tender.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tender_reference_no">{{ trans('cruds.tenderManagement.fields.tender_reference_no') }}</label>
                <input onkeypress="return blockSpecialChar(event)" class="form-control {{ $errors->has('tender_reference_no') ? 'is-invalid' : '' }}" type="text" name="tender_reference_no" id="tender_reference_no" value="{{ old('tender_reference_no', '') }}" required>
                @if($errors->has('tender_reference_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tender_reference_no') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="category_code">{{ trans('cruds.tenderManagement.fields.tender_title') }}</label>
                <input onkeypress="return blockSpecialChar(event)" class="form-control {{ $errors->has('tender_title') ? 'is-invalid' : '' }}" type="text" name="tender_title" id="tender_title" value="{{ old('tender_title', '') }}" required>
                @if($errors->has('tender_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tender_title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="tender_discription">{{ trans('cruds.tenderManagement.fields.description') }} {{ trans('cruds.tenderManagement.fields.description_helper') }}</label>
                <textarea class="form-control {{ $errors->has('tender_discription') ? 'is-invalid' : '' }}" name="tender_discription" id="tender_discription"   required ></textarea>
                @if($errors->has('tender_discription'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tender_discription') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="open_date">{{ trans('cruds.tenderManagement.fields.open_date') }} (YY-MM-DD)</label>
                <input onkeypress="return blockSpecialChar(event)" class="form-control open_date {{ $errors->has('open_date') ? 'is-invalid' : '' }}" type="text" name="open_date" id="open_date" value="{{ old('open_date', '') }}" required>
                @if($errors->has('open_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('open_date') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="close_date">{{ trans('cruds.tenderManagement.fields.close_date') }} (YY-MM-DD)</label>
                <input onkeypress="return blockSpecialChar(event)" class="form-control close_date {{ $errors->has('close_date') ? 'is-invalid' : '' }}" type="text" name="close_date" id="close_date" value="{{ old('close_date', '') }}" required>
                @if($errors->has('close_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('close_date') }}
                    </div>
                @endif
               
            </div>
                
            <div class="form-group">
                <label class="">{{ trans('cruds.tenderManagement.fields.category_name') }}</label>
                <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id" >
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($material_array as $key => $label)
                    <option value="{{ $label['id'] }}" {{ old('category_id', '') === (string) $label['id'] ? 'selected' : '' }}>{{ $label['category_name'] }}</option>
                    @if(isset($label['sub']) AND count($label['sub']) > 0)
                        @foreach($label['sub'] as $key1 => $label1)
                        <option value="{{ $label1['id'] }}" {{ old('category_id', '') === (string) $label1['id'] ? 'selected' : '' }}>-{{ $label1['category_name'] }}</option>
                        @endforeach
                    @endif
                    @endforeach
                </select>
                @if($errors->has('parent_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_id') }}
                    </div>
                @endif
            </div>

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
           
            <div class="form-group">
                <label class="required" for="document">{{ trans('cruds.tenderManagement.fields.document') }} </label>
                
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
    //$("#tender-from").validate();

    $("#tender-from").validate({ 
        onfocusout: function(e) {  // this option is not needed
            this.element(e);       // this is the default behavior
        },
        rules:{
            category_id: { required: true }

             
        },
        messages: {  // <-- you must declare messages inside of "messages" option
            'category_id':{
                required:"This field is required",                  
               
            }
        }
    });

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


});
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
</script>
@endsection


