@extends('layouts.app')

@section('content')
<script>
    let user = <?php echo json_encode($user); ?>;
    user['role'] = <?php echo json_encode($user->getRoleNames()[0]); ?>;
    user['name'] = user['full_name'] + `(${user['role']})`;
    user['email'] = user['email'].split('@')[0] + user['id'];
</script>
    <div id="app">
    </div>
@endsection