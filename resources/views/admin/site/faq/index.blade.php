@extends('layouts.admin_dashboard')
@section('breadcrumb')
Faq's
@endsection
@section('content')
@include('flash-message')

{{-- <div id="message"></div> --}}
<div class="panel panel-default">
    <div class="panel-heading">FAQs </div>
    <div class="panel-body">
{{-- Start add faq form --}}
<form method="POST" action="{{ url('admin/faqs') }}" aria-label="{{ __('Add New FAQ') }}">
    @csrf

    <div class="form-group row">
        <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

        <div class="col-md-6">
            <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" required autocomplete="question" autofocus>
            @error('question')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>

        <div class="col-md-6">
            <input id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ old('answer') }}" required autocomplete="answer" autofocus>
            @error('answer')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>
        </div>
    </div>
</form>
<br>
{{-- End add faq form --}}

<hr>
<table class="table table-bordered">
    <thead>
       <tr>
          <th>FAQ</th>
          <th>Answer</th>
          <th>Status</th>
       </tr>
    </thead>
    <tbody>
       @foreach($faqs as $faq)
          <tr>
             <td>{{ $faq->question }}</td>
             <td>{{ $faq->answer }}</td>
             <td>
                <input data-id="{{$faq->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $faq->status ? 'checked' : '' }}>
             </td>
             {{-- @if ( $faq->status  == "1")
            <td> <a class="btn btn-success" href="{{ URL::to('admin/faq/change/'.$faq->id) }}">ACTIVE
                <i class=""></i>
                </a>
            </td>
            @else
            <td> <a class="btn btn-danger" href="{{ URL::to('admin/faq/change/'.$faq->id) }}">INACTIVE
                <i class=""></i>
                </a>
            </td>
            @endif --}}
        </tr>
       @endforeach
    </tbody>
</table>
    </div></div>
@endsection
@section('javascript')
<script>
    $(function() {
      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var faq_id = $(this).data('id');

          $.ajax({
              type: "GET",
              dataType: "json",
              url: '{{ url("/admin/faqs/change")}}',
              data: {'status': status, 'faq_id': faq_id},
              success: function(data){
                $('#message').html('<p class="alert alert-success">'+data.success+'</p>')
              }
          });
      })
    })
  </script>
@endsection
