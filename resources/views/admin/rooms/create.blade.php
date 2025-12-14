@extends('layouts.main')

@section('content')

<style>
.form-container {
    max-width: 650px;
    margin: auto;
    background: #fff;
    padding: 32px;
    border-radius: 18px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}
.form-group { margin-bottom: 18px; }
.form-group label { font-weight:600; margin-bottom:6px; display:block; }
.form-control {
    width:100%; padding:12px 14px;
    border-radius:10px; border:1px solid #ccc;
}
textarea.form-control { height:120px; resize:none; }
.mellow-btn {
    background:#F5EDE6; color:#000;
    padding:14px 28px; border-radius:12px;
    border:none; font-weight:600; cursor:pointer;
}
.mellow-btn:hover { background:#e8dfd7; }
</style>

<div class="form-container">

<h2 class="mb-4">Add New Room</h2>

<form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Room Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group">
        <label>Price</label>
        <input type="number" name="price" class="form-control">
    </div>

    <div class="form-group">
        <label>Capacity</label>
        <input type="number" name="capacity" class="form-control">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="mellow-btn">Create</button>
</form>

</div>

@endsection
