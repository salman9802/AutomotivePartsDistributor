console.log('Script');

/*
// Testing GET Request: Get all users
fetch('http://localhost/CollegeProject/AutomotivePartsDistributor/api/get/get-all-users.php').then(response => response.json()).then(data =>{
    const users = data;
    let html = `<table><tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td>Email</td>
                        <td>Mobile</td>
                    </tr>`;
        users.forEach(user => {
            html += `<tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.password}</td>
                        <td>${user.email}</td>
                        <td>${user.mobile}</td>
                    </tr>`;
        });
        html += '</table>';
        document.getElementById('response').innerHTML = html;
});
*/

// Testing post request: Get specific user
const id = 5;
const params = {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: 'id=' + id
}
fetch('http://localhost/CollegeProject/AutomotivePartsDistributor/api/post/get-user.php', params).then(response => response.json()).then(data =>{
    const users = data;
    let html = `<table><tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td>Email</td>
                        <td>Mobile</td>
                    </tr>`;
        users.forEach(user => {
            html += `<tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.password}</td>
                        <td>${user.email}</td>
                        <td>${user.mobile}</td>
                    </tr>`;
        });
        html += '</table>';
        document.getElementById('response').innerHTML = html;
});