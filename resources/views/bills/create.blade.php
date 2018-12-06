<?php  ?>
@extends('layouts.master')
@section('content')
    @include('bills/createForm')
    
@endsection
@push('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( "#dateofbill" ).datepicker({dateFormat: "dd-mm-y"});

    var suppliers=[
    @foreach ($bill['suppliers'] as $supplier)
        {
        id:{{$supplier->id}},
        value:"{{$supplier->name}}"
        },
    @endforeach];
    $('#supplier').autocomplete({
        source:suppliers,
        
        {{-- function(request,response){
            response($.map(suppliers,function(item){
                return{
                    id:item.id,
                    value:item.value
                }
            }))
        }, --}}
        select:function(event,ui){
            $(this).val(ui.item.value)
            $('#supplier_id').val(ui.item.id);
        },
        minLength:0,
        autoFocus:true,
      });
</script>
@endpush