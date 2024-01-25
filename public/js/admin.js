function deleteUser(userId) {
    var confirmation = confirm("Are you sure you want to delete this user?");

    if (confirmation) {
        fetch('/deleteUser', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ userId: userId }),
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                window.location.href = "adminPanel";
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting user. Please try again.');
            });
    }
}