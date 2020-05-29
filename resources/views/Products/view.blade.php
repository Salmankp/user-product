@include('layouts.app')
@include('_partials.navbar')

<div id="app">
            <view-products :user="{{json_encode( Auth::user())}}"></view-products>
</div>



@include('_partials.footer')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
--}}
