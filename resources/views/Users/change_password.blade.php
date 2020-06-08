@include('layouts.app')
@include('_partials.navbar')

<div id="app">
    <change-password :user="{{json_encode( Auth::user())}}"></change-password>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
--}}
