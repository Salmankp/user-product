@include('layouts.app')
@include('_partials.navbar')

<div id="app">
    <view-users :user="{{json_encode( Auth::user())}}"></view-users>
</div>



@include('_partials.footer')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
