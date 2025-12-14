@extends('layouts.main')

@section('content')

<style>
.form-container {
    max-width: 650px;
    margin: auto;
    background: #ffffff;
    padding: 32px;
    border-radius: 18px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}

.form-group { margin-bottom: 18px; }

.form-group label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.form-control {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #ccc;
}

.mellow-btn {
    background: #F5EDE6;
    color: #000;
    padding: 14px 28px;
    border-radius: 12px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: 0.25s;
}

.mellow-btn:hover {
    background: #e8dfd7;
}
</style>


<div class="form-container">

    <h2 class="mb-4">Add New Staff</h2>

    <form action="/admin/staff" method="POST">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="">-- Select Gender --</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <div class="form-group">
            <label>Nationality</label>
            <select name="nationality" class="form-control" required>
                <option value="">-- Select Country --</option>
                <option>Maldives</option>
                <option>India</option>
                <option>Sri Lanka</option>
                <option>Bangladesh</option>
                <option>Pakistan</option>
                <option>Nepal</option>
                <option>USA</option>
                <option>UK</option>
                <option>Canada</option>
                <option>Australia</option>
            </select>
        </div>

        <button class="mellow-btn">Create Staff</button>

    </form>
</div>

@endsection
