<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit-profile-style.css') }}">
    <title>Edit Profile</title>
</head>
<body>
    <div class="container">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-profile-form">
            @csrf
            @method('PATCH')

            <div class="avatar-section">
                <label for="new_avatar" class="avatar-label">Update Avatar:</label>
                <div class="current-avatar">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar">
                    @else
                        <p class="no-avatar">No avatar uploaded.</p>
                    @endif
                </div>
                <input type="file" name="new_avatar" id="new_avatar" class="avatar-input">
            </div>

            <div class="bio-section">
                <label for="bio" class="bio-label">Bio:</label>
                <textarea name="bio" id="bio" class="bio-textarea">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <!-- Add other fields as needed -->

            <button type="submit" class="update-button">Update Profile</button>
        </form>
    </div>
</body>
</html>
