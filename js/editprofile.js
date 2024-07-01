document.getElementById('edit-profile-form').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Profile updated successfully!');
});

document.getElementById('cancel-button').addEventListener('click', function() {
    alert('Changes cancelled.');
});
