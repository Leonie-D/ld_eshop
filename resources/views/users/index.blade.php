@extends('layouts.app')

@section('title') {{__("Manage customers' accounts")}} @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h2>{{__("Manage customers' accounts")}}</h2>
                        <a class="btn btn-primary" href={{route('backoffice.admin')}}>
                            {{__('Back to dashboard')}}
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table bg-white">
                            <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Firstname')}}</th>
                                <th>{{__('Orders number')}}</th>
                                <th>{{__('See customer profil')}}</th>
                                <th>{{__('Edit customer profil')}}</th>
                                <th>{{__('Delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->firstname}}</td>
                                    <td>{{$user->orders()->count()}}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href={{route('user.show', ['user' => $user])}}>
                                            {{__('See')}}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href={{route('user.edit', ['user' => $user])}}>
                                            {{__('Edit')}}
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{route('user.destroy', ['user' => $user])}}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger"
                                                    value="delete-user">
                                                {{__('Delete')}}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


