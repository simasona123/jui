@extends('layouts.app')

@section('content')
<script>
    let user = <?php echo json_encode($user); ?>;
    user['role'] = <?php echo json_encode($user->getRoleNames()[0]); ?>;
</script>
@vite('resources/js/chat.js')
<div id="app">
</div>
@endsection