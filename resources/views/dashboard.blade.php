<?php 
use Illuminate\Support\Carbon;
?>
@extends('layouts.app')


@section('content')
    <h1>Dashboard</h1>
    {{ Carbon::now()->format('Y-m-d'); }}
@endsection