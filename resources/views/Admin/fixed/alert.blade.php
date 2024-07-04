@if(Session::has('message'))
    <!-- <div class="alert {{ Session::get('class') == '1' ? 'alert-success' : 'alert-danger' }}" role="alert"> -->
	<div class="row">

        @if(Session::get('class') == 0)
        <div class="alert alert-error fixed-padding-left" role="alert">
            <i class="icon ion-alert-circled alert-font-size" aria-hidden="true"></i>
        @elseif ( Session::get('class') == 1)
        <div class="alert alert-success fixed-padding-left" role="alert">
            <i class="icon ion-android-checkmark-circle alert-font-size" aria-hidden="true"></i>
        @elseif ( Session::get('class') == 2)
        <div class="alert alert-cancel fixed-padding-left" role="alert">
            <i class="icon ion-alert-circled alert-font-size" aria-hidden="true"></i>
        @else
        <div class="alert alert-view fixed-padding-left" role="alert">
            <i class="icon ion-alert-circled alert-font-size" aria-hidden="true"></i>
        @endif
        <button type="button" class="close" data-dismiss="alert">×</button>
            {{ Session::get('message') }}
        </div>
    </div>
 @endif


 @if (count($errors) > 0)
    <div class="alert alert-danger fixed-padding-left" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
