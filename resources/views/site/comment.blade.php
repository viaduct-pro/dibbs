@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <?php
                            $user_id = $comment->user_id;
                            $user = \App\Models\User::where(['id' => $user_id])->first();
                            ?>
                        <div class="panel-heading">
                            {{$user->name}}
                        </div>

                        <div class="panel-body">
                            {{$comment->comment}}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection